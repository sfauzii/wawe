<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use Illuminate\Support\Carbon;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);
        return view('pages.checkout', [
            'item' => $item,
        ]);
    }

    public function process(Request $request, $id)
    {
        $travel_package = TravelPackage::findOrFail($id);

        if ($travel_package->kuota > 0) {
        // Kurangi kuota
        $travel_package->kuota--;
        $travel_package->save();

        // Buat transaksi
        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'transaction_total' => $travel_package->price,
            'transaction_status' => 'IN_CART',
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
        ]);

        return redirect()->route('checkout', $transaction->id);
    } else {
        // Jika kuota sudah habis, kembalikan pengguna ke halaman sebelumnya dengan pesan error
        return back()->with('error', 'Sorry, the quota for this travel package has been exhausted.');
    }
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details', 'travel_package'])->findOrFail($item->transactions_id);

        if ($item->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }

        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
        ]);

        $userPhone = Auth::user()->phone;

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['travel_package'])->find($id);

        if ($request->is_visa) {
            $transaction->transaction_total += 190;
            $transaction->additional_visa += 190;
        }

        $transaction->transaction_total += $transaction->travel_package->price;

        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();


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

        // Buat array untuk dikirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['bank_transfer', 'qris'],
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

    public function check() {
        return view('pages.checkout');
    }
}
