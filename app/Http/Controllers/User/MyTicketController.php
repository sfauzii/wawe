<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyTicketController extends Controller
{
    public function index(Request $request, $username, $id)
    {


        // Pastikan pengguna yang login sesuai dengan username yang diminta
        if (Auth::user()->username !== $username) {
            return redirect()->route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]);
        }

        // Ambil data pengguna berdasarkan username dan id
        $user = User::where('username', $username)->where('id', $id)->firstOrFail();

        $transactions = Transaction::with(['details', 'travel_package.galleries'])
            ->where('transaction_status', 'SUCCESS')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.users.tickets.my-ticket', [
            'items' => $transactions,
            'user' => $user,
        ]);
    }

    public function detail($id)
    {


        $transaction = Transaction::with(['details', 'travel_package.galleries'])->findOrFail($id);

        $user = Auth::user();

        $item = Transaction::with(['details', 'travel_package'])->findOrFail($id);

        $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id);

        // Check if departure date has passed
        $canGiveTestimony = Carbon::parse($transaction->travel_package->departure_date)->isPast();

        return view('pages.users.tickets.ticket-detail', [
            'transaction' => $transaction,
            'user' => $user,
            'item' => $item,
            'transactionDetails' => $transactionDetails,
            'canGiveTestimony' => $canGiveTestimony,
        ]);
    }

    public function ticketPdf($id)
    {

        $transaction = Transaction::with(['details', 'travel_package'])->findOrFail($id);

        $user = Auth::user();

        $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id);

        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);
        $pdf = Pdf::loadView('pages.users.tickets.reports.my-ticket-pdf', compact('transaction', 'user', 'item', 'transactionDetails'))->setPaper('a4', 'potrait');

        return $pdf->stream('Ticket ' . $user->name . '.pdf');
    }
}
