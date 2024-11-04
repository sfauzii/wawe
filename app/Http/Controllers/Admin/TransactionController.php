<?php

namespace App\Http\Controllers\Admin;

use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\TransactionRequest;
use App\Models\MidtransNotification;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create transaction')->only(['create', 'store']);
        $this->middleware('check.permission:view transaction')->only('index');
        $this->middleware('check.permission:edit transaction')->only(['edit', 'update']);
        $this->middleware('check.permission:delete transaction')->only(['destroy']);
    }

    public function index()
    {
        $status = request()->get('status', 'ALL');

        $query = Transaction::with(['details', 'travel_package', 'user'])->orderBy('created_at', 'desc');

        if ($status !== 'ALL') {
            $query->where('transaction_status', $status);
        }

        $items = $query->get();

        // Hitung jumlah transaksi berdasarkan status
        $countPending = Transaction::where('transaction_status', 'PENDING')->count();
        $countSuccess = Transaction::where('transaction_status', 'SUCCESS')->count();
        $countFailed = Transaction::where('transaction_status', 'EXPIRED')->count();
        $countInCart = Transaction::where('transaction_status', 'IN_CART')->count();
        $countCancelled = Transaction::where('transaction_status', 'CANCEL')->count();

        return view('pages.admin.transaction.index', [
            'items' => $items,
            'selectedStatus' => $status,
            'countPending' => $countPending,
            'countSuccess' => $countSuccess,
            'countFailed' => $countFailed,
            'countInCart' => $countInCart,
            'countCancelled' => $countCancelled,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $travelPackages = TravelPackage::all();

        return view('pages.admin.transaction.create', [
            'travelPackages' => $travelPackages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        // $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        // // Cari atau buat user berdasarkan username
        // $user = User::firstOrCreate(
        //     ['username' => $request->input('username')],
        //     [
        //         'name' => $request->input('username'),
        //         'email' => $request->input('username') . '@example.com',
        //         'password' => Hash::make('defaultpassword'), // Set password default
        //     ],
        // );

        // // Pastikan travel_packages_id dan users_id diisi
        // $data['travel_packages_id'] = $request->input('travel_package_id');
        // $data['users_id'] = $user->id;

        // // Hitung total transaksi berdasarkan jumlah pengguna dan harga paket
        // $travelPackage = TravelPackage::findOrFail($data['travel_packages_id']);
        // $userCount = count($request->input('users', [])); // +1 to include the main user
        // $data['transaction_total'] = $travelPackage->price * $userCount;

        // // Kurangi kuota travel package
        // if ($travelPackage->kuota < $userCount) {
        //     // return redirect()->back()->with('error', 'Not enough quota for the selected travel package.');
        //     Alert::error('Error','No more quota available for this travel package.')
        //         // ->position('top-end')
        //         ->autoClose(3000)
        //         ->timerProgressBar();

        //     return back();
        // }
        // $travelPackage->kuota -= $userCount;
        // $travelPackage->save();

        // // Buat transaksi dengan status PENDING secara otomatis
        // $transaction = Transaction::create([
        //     'travel_packages_id' => $data['travel_packages_id'],
        //     'users_id' => $data['users_id'],
        //     'transaction_total' => $data['transaction_total'],
        //     'transaction_status' => 'PENDING', // Set status ke PENDING secara otomatis
        // ]);

        // TransactionDetail::create([
        //     'transactions_id' => $transaction->id,
        //     'username' => $user['username'],
        // ]);

        // foreach ($request->input('users', []) as $userDetail) {
        //     if (isset($userDetail['username']) && !empty($userDetail['username'])) {
        //         TransactionDetail::create([
        //             'transactions_id' => $transaction->id,
        //             'username' => $userDetail['username'],
        //             // ... other fields
        //         ]);
        //     }
        // }

        // // $snapToken = $this->generatePaymentUrl($transaction);

        // return view('pages.admin.transaction.payment', [
        //     // 'snapToken' => $snapToken,
        //     'transaction' => $transaction,
        // ]);

        // $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        // Transaction::create($data);
        // return redirect()->route('transaction.index');
    }

    public function payment(Transaction $transaction)
    {
        return view('pages.admin.transaction.payment', compact('transaction'));
    }
    public function generatePaymentUrl(Request $request, $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        $random = rand(100, 999);
        $transaction->order_id = 'WW' . date('Ymd') . $random;
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $transaction->order_id,
                'gross_amount' => (int) $transaction->grand_total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['bank_transfer', 'gopay', 'qris'],
            'vtweb' => [],
        ];

        try {
            // buat transaction dan dapatkan url pembayaran
            $response = Snap::createTransaction($midtrans_params);

            // periksa apakah url pembayaran valid
            if (!empty($response->redirect_url)) {
                // simpan token snap ke dalam sesi
                session(['snapToken' => $response->token]);

                // simpan url pembayaran ke dalam transaction
                $transaction->payment_url = $response->redirect_url;
                $transaction->save();

                header('Location: ' . $response->redirect_url);
                exit(); // Pastikan tidak ada output lain sebelum header redirect
            } else {
                throw new \Exception('Failed to generate payment URL.');
            }
        } catch (\Exception $e) {
            // tangain kesalahan jika terjadi
            echo 'Error: ' . $e->getMessage();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);

        $transactionDetails = TransactionDetail::where('transactions_id', $item->id);

        // Count the number of users (transaction details)
        $userCount = $transactionDetails->count();

        // Get the price per user
        $pricePerUser = $item->travel_package->price;

        // Calculate full payment (without any down payment)
        $fullPayment = $userCount * $pricePerUser;

        // Initialize remaining full payment as null
        $remainingFullPayment = null;

        // Check if the payment method is down_payment
        if ($item->payment_method === 'down_payment') {
            $remainingPayment = $fullPayment * 0.7; // Remaining 70% after down payment
            $remainingPPN = $remainingPayment * 0.11; // 11% PPN on remaining amount
            $remainingFullPayment = $remainingPayment + $remainingPPN; // Total remaining payment
        }

        // Ambil semua data notifikasi Midtrans untuk transaksi ini
        $midtransNotifications = MidtransNotification::where('order_id', $item->order_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $midtransData = $midtransNotifications->map(function ($notification) {
            return json_decode($notification->payload, true);
        });

        return view('pages.admin.transaction.detail', [
            'item' => $item,
            'transactionDetails' => $transactionDetails,
            'midtransData' => $midtransData,
            'remainingFullPayment' => $remainingFullPayment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Transaction::findOrfail($id);

        return view('pages.admin.transaction.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = Transaction::findOrFail($id);

        $item->update($data);

        // Session::flash('success', 'Transaction updated successfully.');
        Alert::success('Success', 'Transaction updated successfully.');

        // return redirect()->route('transaction.index');

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        // Session::flash('success', 'Transaction deleted successfully.');
        Alert::success('Success', 'Transaction deleted successfully.');

        return redirect()->route('transaction.index');
    }

    public function downloadPdf(string $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);

        $transactionDetails = TransactionDetail::where('transactions_id', $item->id);

        // Count the number of users (transaction details)
        $userCount = $transactionDetails->count();

        // Get the price per user
        $pricePerUser = $item->travel_package->price;

        // Calculate full payment (without any down payment)
        $fullPayment = $userCount * $pricePerUser;

        // Initialize remaining full payment as null
        $remainingFullPayment = null;

        // Check if the payment method is down_payment
        if ($item->payment_method === 'down_payment') {
            $remainingPayment = $fullPayment * 0.7; // Remaining 70% after down payment
            $remainingPPN = $remainingPayment * 0.11; // 11% PPN on remaining amount
            $remainingFullPayment = $remainingPayment + $remainingPPN; // Total remaining payment
        }

        $pdf = Pdf::loadView('pages.admin.transaction.reports.invoice-pdf', [
            'item' => $item,
            'transactionDetails' => $transactionDetails,
            'remainingFullPayment' => $remainingFullPayment
        ]);

        return $pdf->download('Invoice ' . ucfirst($item->user->name) . '.pdf');
    }

    public function ticketPdf(string $id)
    {

        $transaction = Transaction::with(['details', 'travel_package'])->findOrFail($id);

        $user = Auth::user();

        $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id);

        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('pages.admin.tickets.ticket-pdf', compact('transaction', 'user', 'item', 'transactionDetails'))->setPaper('a4', 'potrait');

        return $pdf->stream('Ticket ' . $item->details->first()->username . '.pdf');
    }
}
