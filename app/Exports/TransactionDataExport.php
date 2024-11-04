<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionDataExport implements FromView, ShouldAutoSize
{

    private $transactions;
    private $totalTransaction;
    private $transactionCount;
    private $averagePerTransaction;
    private $highestTransaction;
    private $lowestTransaction;
    private $totalPackagesSold;

    public function __construct($startDate, $endDate)
    {
        $transactions = Transaction::with('details')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        $successfulTransactions = $transactions->where('transaction_status', 'SUCCESS');

        $this->transactions = $transactions;
        $this->totalTransaction = $successfulTransactions->sum('grand_total');
        $this->transactionCount = $successfulTransactions->count();
        $this->averagePerTransaction = $this->transactionCount > 0 ? $this->totalTransaction / $this->transactionCount : 0;
        $this->highestTransaction = $successfulTransactions->max('grand_total');
        $this->lowestTransaction = $successfulTransactions->min('grand_total');
        $this->totalPackagesSold = $successfulTransactions->countBy('travel_package.title')->sum();
    }

    public function view(): View
    {
        return view('pages.admin.report.transaction.excel', [
            
            'transactions' => $this->transactions,
            'totalTransaction' => $this->totalTransaction,
            'transactionCount' => $this->transactionCount,
            'averagePerTransaction' => $this->averagePerTransaction,
            'highestTransaction' => $this->highestTransaction,
            'lowestTransaction' => $this->lowestTransaction,
            'totalPackagesSold' => $this->totalPackagesSold
        ]);
    }
}
