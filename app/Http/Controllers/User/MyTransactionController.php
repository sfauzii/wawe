<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyTransactionController extends Controller
{
    public function index($username, $id)
    {

        // Pastikan pengguna yang login sesuai dengan username yang diminta
        if (Auth::user()->username !== $username) {
            return redirect()->route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]);
        }

        // Ambil data pengguna berdasarkan username dan id
        $user = User::where('username', $username)->where('id', $id)->firstOrFail();


        $transactions = Transaction::with(['details', 'travel_package.galleries'])
            ->orderBy('created_at', 'desc',)
            ->where('users_id', $user->id)
            ->whereIn('transaction_status', ['SUCCESS', 'PENDING'])
            ->get();

        return view('pages.users.transactions.my-transactions', [
            'user' => $user,
            'items' => $transactions,
        ]);
    }

    public function invoice($id)
    {

        $transaction = Transaction::with(['details', 'travel_package'])->findOrFail($id);
        $user = Auth::user();

        $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id);

        return view('pages.users.transactions.invoice', [
            'transaction' => $transaction,
            'user' => $user,
            'transactionDetails' => $transactionDetails,
        ]);
    }


    public function invoicepdf($id) {
        $transaction =  Transaction::with(['details', 'travel_package'])->findOrFail($id);
        $user = Auth::user();

        $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id);

        $pdf = Pdf::loadview('pages.users.transactions.reports.invoice-pdf', compact('transaction', 'user', 'transactionDetails'))->setPaper('a4', 'potrait');

        return $pdf->stream('Invoice ' . $user->name . '.pdf');

    }

    
}
