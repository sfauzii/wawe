<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class SearchNav extends Component
{

    public $searchTerm = "";

    public function render()
    {
        $userId = Auth::id();
        $searchTerm = '%' . $this->searchTerm . '%';
        $transactions = Transaction::with(['details', 'travel_package', 'user'])
            ->where('users_id', $userId)
            ->where(function($query) use ($searchTerm) {
                $query->whereHas('details', function ($query) use ($searchTerm) {
                    $query->where('username', 'like', $searchTerm);
                })
                ->orWhereHas('travel_package', function ($query) use ($searchTerm) {
                    $query->where('title', 'like', $searchTerm);
                })
                ->orWhereHas('user', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                })
                ->orWhere('transaction_status', 'like', $searchTerm);
            })
            ->get();
        return view('livewire.search-nav', [
            'transactions' => $transactions,
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
}
