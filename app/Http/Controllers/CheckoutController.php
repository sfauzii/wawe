<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Role;
use App\Models\User;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use Illuminate\Support\Carbon;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewTransactionNotification;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);

        // Check if departure date has passed
        $departureDate = Carbon::parse($item->travel_package->departure_date);
        if ($departureDate->isPast()) {

            alert()->error('Error', 'Perjalanan ini tidak dapat dipesan karena tanggal keberangkatan telah lewat. Harap tunggu jadwal baru yang tersedia.');

            return redirect()->back();
        }


        return view('pages.checkout', [
            'item' => $item,
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findOrFail($id);

        // Check if the logged-in user has a phone number
        if (empty(Auth::user()->phone)) {
            Alert::html('Error', 'Please complete your phone details in your profile before proceeding.', 'error')
                ->showConfirmButton('<button onclick="window.location.href=\'' . route('edit-profile', Auth::user()->id) . '\'" style="background-color: #3085d6; color: #fff; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor=\'#2a75d4\'" onmouseout="this.style.backgroundColor=\'#3085d6\'">Edit Profile</button>')
                ->autoClose(false);

            return back();
        }

        // Generate order_id
        $random = rand(1000, 9999);
        $order_id = 'WW' . date('Ymd') . $random;

        // Create transaction
        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'order_id' => $order_id,
            'transaction_status' => 'IN_CART',
        ]);

        // Ensure phone number is filled in, either from the user's profile or form input
        $phone = $request->phone ?? Auth::user()->phone;

        if (empty($phone)) {
            Alert::error('Error', 'Phone number is required.');
            return back();
        }

        // Create transaction detail
        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'phone' => $phone,
        ]);

        // Send notification to admins
        // Send notification only to users with 'get-notification' permission
        $usersWithPermission = User::permission('get-notification')->get();

        Notification::send(
            $usersWithPermission,
            new NewTransactionNotification($transaction)
        );

        // Redirect to checkout
        return redirect()->route('checkout', $transaction->id);

        // if ($travel_package->kuota > 0) {
        //     // Reduce quota
        //     $travel_package->kuota--;
        //     $travel_package->save();

        //     // Create transaction
        //     $transaction = Transaction::create([
        //         'travel_packages_id' => $id,
        //         'users_id' => Auth::user()->id,
        //         'order_id' => $order_id,
        //         'transaction_status' => 'IN_CART',
        //     ]);

        //     // Ensure phone number is filled in, either from the user's profile or form input
        //     $phone = $request->phone ?? Auth::user()->phone;

        //     if (empty($phone)) {

        //         Alert::error('Error', 'Phone number is required.');

        //         return back();
        //     }

        //     // Create transaction detail
        //     TransactionDetail::create([
        //         'transactions_id' => $transaction->id,
        //         'username' => Auth::user()->username,
        //         'phone' => $phone,
        //     ]);


        //     // Send notification to admins
        //     // Send notification only to users with 'get-notification' permission
        //     $usersWithPermission = User::permission('get-notification')->get();

        //     Notification::send(
        //         $usersWithPermission,
        //         new NewTransactionNotification($transaction)
        //     );
        //     // $roles = Role::whereIn('name', ['super-admin', 'admin'])->get();
        //     // $admins = User::whereHas('roles', function ($query) use ($roles) {
        //     //     $query->whereIn('id', $roles->pluck('id'));
        //     // })->get();

        //     // Notification::send($admins, new NewTransactionNotification($transaction));

        //     return redirect()->route('checkout', $transaction->id);
        // } else {
        //     toast('Sorry, the quota for this travel package has been exhausted.', 'error');
        //     return back();
        // }
    }

    public function cancelBooking($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Check if the logged-in user is the owner of the transaction
        if ($transaction->users_id != Auth::user()->id) {
            return back()->with('error', 'You are not authorized to cancel this booking.');
        }

        // Check if the transaction is still in a cancellable state
        if ($transaction->transaction_status == 'CANCEL' || $transaction->transaction_status == 'SUCCESS') {
            return back()->with('error', 'This booking cannot be canceled.');
        }

        // Get the number of users in the transaction
        $user_count = TransactionDetail::where('transactions_id', $transaction->id)->count();

        // Increase the quota
        $travel_package = TravelPackage::findOrFail($transaction->travel_packages_id);
        $travel_package->kuota += $user_count;
        $travel_package->save();

        // Update the transaction status
        $transaction->transaction_status = 'CANCEL';
        $transaction->save();

        // Send notification to admins
        // Send notification only to users with 'get-notification' permission
        $usersWithPermission = User::permission('get-notification')->get();

        Notification::send(
            $usersWithPermission,
            new NewTransactionNotification($transaction)
        );

        Alert::success('Success', 'Booking canceled successfully.');

        return redirect()->route('details', $travel_package->slug);
        // return redirect()
        //     ->route('details', $travel_package->slug)
        //     ->with('success', 'Booking canceled successfully.');
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details', 'travel_package'])->findOrFail($item->transactions_id);
        $travelPackage = $transaction->travel_package;

        // if ($item->is_visa) {
        //     $transaction->transaction_total -= 190;
        //     $transaction->additional_visa -= 190;
        // }

        // $transaction->transaction_total -= $travelPackage->price;

        // Restore the quota
        $travelPackage->kuota += 1;
        $travelPackage->save();

        $item->delete();
        $transaction->save();

        toast('User success not added', 'success');

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string',
            'phone' => 'required|numeric|digits_between:10,15',
        ], [
            'phone.digits_between' => 'The phone number must be between 10 and 15 digits.',
            'phone.required' => 'The phone number is required.',
            'phone.numeric' => 'The phone number must only contain numbers.',
        ]);

        $userPhone = Auth::user()->phone;

        $transaction = Transaction::with(['travel_package'])->find($id);
        $travelPackage = $transaction->travel_package;

        // Check if there's enough quota available
        // if ($travelPackage->kuota <= 0) {
        //     // return back()->withErrors(['message' => 'No more quota available for this travel package.']);
        //     Alert::error('Error', 'No more quota available for this travel package.')
        //         // ->position('top-end')
        //         ->autoClose(3000)
        //         ->timerProgressBar();

        //     return back();
        // }

        $data = $request->all();
        $data['transactions_id'] = $id;

        // Create the transaction detail
        TransactionDetail::create($data);

        // Decrement the quota
        $travelPackage->kuota -= 1;
        $travelPackage->save();

        // if ($request->is_visa) {
        //     $transaction->transaction_total += 190;
        //     $transaction->additional_visa += 190;
        // }

        // $transaction->transaction_total += $transaction->travel_package->price;

        $transaction->save();

        toast('User success added', 'success');

        // Kirim notifikasi ke admin dan super-admin
        // $roles = Role::whereIn('name', ['super-admin', 'admin'])->get();
        // $admins = User::whereHas('roles', function ($query) use ($roles) {
        //     $query->whereIn('id', $roles->pluck('id'));
        // })->get();

        // Notification::send($admins, new NewTransactionNotification($transaction));

        // Send notification only to users with 'get-notification' permission
        $usersWithPermission = User::permission('get-notification')->get();

        Notification::send(
            $usersWithPermission,
            new NewTransactionNotification($transaction)
        );

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);

        // Check if there are no users in the transaction details
        if ($transaction->details->isEmpty()) {
            // Show error alert if there are no users
            Alert::error('Error', 'No users found for this transaction. Please add users before proceeding.')
                ->autoClose(3000)
                ->timerProgressBar();

            // Redirect back to the previous page
            return back();
        }

        $transaction->transaction_status = 'PENDING';

        $transaction->save();


        // Kirim notifikasi ke admin dan super-admin
        // Send notification only to users with 'get-notification' permission
        $usersWithPermission = User::permission('get-notification')->get();

        Notification::send(
            $usersWithPermission,
            new NewTransactionNotification($transaction)
        );
        // $roles = Role::whereIn('name', ['super-admin', 'admin'])->get();
        // $admins = User::whereHas('roles', function ($query) use ($roles) {
        //     $query->whereIn('id', $roles->pluck('id'));
        // })->get();

        // Notification::send($admins, new NewTransactionNotification($transaction));

        // Set konfigurasi Midtrans
        // Config::$serverKey = config('midtrans.serverKey');
        // Config::$isProduction = config('midtrans.isProduction');
        // Config::$isSanitized = config('midtrans.isSanitized');
        // Config::$is3ds = config('midtrans.is3ds');

        // $params = [
        //     'transaction_details' => [
        //         'order_id' => 'TEST-' . $transaction->id . '-' . time(),
        //         'gross_amount' => (int) $transaction->transaction_total,
        //     ],
        //     'customer_details' => [
        //         'first_name' => $transaction->user->name,
        //         'email' => $transaction->user->email,
        //     ],
        // ];

        // $snapToken = Snap::getSnapToken($params);

        // // session()->forget('snapToken');

        // // Simpan snap token ke dalam session
        // session()->put('snapToken', $snapToken);

        // return redirect()->route('checkout', ['id' => $id, 'snapToken' => $snapToken]);

        // Redirect ke halaman checkout success jika snap token tersedia
        // if ($snapToken) {
        //     $paymentUrl = Snap::createTransaction($params)->redirect_url;
        //     $paymentUrl .= '?snapToken=' . urlencode($snapToken);

        //     header('Location: ' . $paymentUrl);
        // } else {
        //     // Tanggapi jika snap token tidak tersedia
        //     return redirect()->route('home')->with('error', 'Snap token tidak tersedia.');
        // }

        // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = [
        //     'transaction_details' => [
        //         'order_id' => 'TEST-' . $transaction->id,
        //         'gross_amount' => (int) $transaction->transaction_total,
        //     ],
        //     'customer_details' => [
        //         'first_name' => $transaction->user->name,
        //         'email' => $transaction->user->email,
        //     ],
        // ];

        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        // // Simpan snap token ke dalam session agar bisa diakses di view
        // session()->put('snapToken', $snapToken);

        // // Redirect ke halaman checkout success
        // if ($snapToken) {
        //     return redirect()->route('detail', $id);
        // } else {
        //     // Handle jika tidak dapat memperoleh snapToken
        //     // Misalnya, tampilkan pesan error atau redirect ke halaman lain
        // }

        // $transaction->save();

        // // Set mindtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');


        $random = rand(100, 999);
        $transaction->order_id = 'WW' . date('Ymd') . $random;
        // Buat array untuk dikirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $transaction->order_id,
                'gross_amount' => (int) $transaction->grand_total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['bank_transfer', 'other_qris', 'gopay', 'dana', 'shopeepay'],
            'vtweb' => [],
        ];

        try {
            // Buat transaksi dan dapatkan URL pembayaran
            $response = Snap::createTransaction($midtrans_params);

            // Periksa apakah ada URL pembayaran yang valid
            if (!empty($response->redirect_url)) {
                // Simpan token Snap ke dalam sesi
                session(['snapToken' => $response->token]);

                // Simpan URL pembayaran ke dalam transaksi
                $transaction->payment_url = $response->redirect_url;
                $transaction->save();
                // Redirect ke halaman pembayaran Midtrans
                header('Location: ' . $response->redirect_url);
                exit(); // Pastikan tidak ada output lain sebelum header redirect
            } else {
                throw new \Exception('Failed to generate payment URL.');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            echo 'Error: ' . $e->getMessage();
        }
    }
}
