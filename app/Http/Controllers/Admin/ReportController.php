<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ReportController extends Controller
{
    public function showFormTransaction(Request $request)
    {
        $startDate = $request->input('start_date', ''); // Default kosong jika tidak ada input
        $endDate = $request->input('end_date', ''); // Default kosong jika tidak ada input

        $transactions = collect();
        if ($startDate && $endDate) {
            $transactions = Transaction::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])

                // where('transaction_status', 'SUCCESS')
                ->get();
        }

        return view('pages.admin.report.transaction.index', compact('startDate', 'endDate', 'transactions'));
    }

    public function generatePDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $transactions = Transaction::with('details') // Eager load details
            // ->where('transaction_status', 'SUCCESS')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        $successfulTransactions = $transactions->where('transaction_status', 'SUCCESS');

        // Calculate total revenue for successful transactions
        $totalTransaction = $successfulTransactions->sum('grand_total');

        // Calculate number of successful transactions
        $transactionCount = $successfulTransactions->count();

        // Calculate average per transaction for successful transactions
        $averagePerTransaction = $transactionCount > 0 ? $totalTransaction / $transactionCount : 0;

        // Calculate the highest and lowest sales for successful transactions
        $highestTransaction = $successfulTransactions->max('grand_total');
        $lowestTransaction = $successfulTransactions->min('grand_total');

        // Count total packages sold for successful transactions
        $totalPackagesSold = $successfulTransactions->countBy('travel_package.title')->sum();

        // Load the PDF view with all transactions, but summary based on successful transactions
        $pdf = FacadePdf::loadView('pages.admin.report.transaction.pdf', compact(
            'transactions',  // Display all transactions
            'startDate',
            'endDate',
            'totalTransaction',   // Summary based on successful transactions
            'transactionCount',
            'averagePerTransaction',
            'highestTransaction',
            'lowestTransaction',
            'totalPackagesSold'
        ))->setPaper('a4', 'portrait');

        // Calculate total revenue
        // $totalTransaction = $transactions->sum('grand_total');

        // // Calculate number of transactions
        // $transactionCount = $transactions->count();

        // // Calculate average per transaction
        // $averagePerTransaction = $transactionCount > 0 ? $totalTransaction / $transactionCount : 0;

        // // Calculate the highest and lowest sales
        // $highestTransaction = $transactions->max('grand_total');
        // $lowestTransaction = $transactions->min('grand_total');

        // // Count total packages sold (assuming each transaction has a `travel_package` relation)
        // $totalPackagesSold = $transactions->countBy('travel_package.title')->sum();

        // $pdf = FacadePdf::loadView('pages.admin.report.transaction.pdf', compact(
        //     'transactions',
        //     'startDate',
        //     'endDate',
        //     'totalTransaction',
        //     'transactionCount',
        //     'averagePerTransaction',
        //     'highestTransaction',
        //     'lowestTransaction',
        //     'totalPackagesSold'
        // ))->setPaper('a4', 'portrait');

        return $pdf->stream('laporan_transaksi.pdf');
    }

    public function showFormPackage(Request $request)
    {
        $start_date = $request->input('start_date', ''); // Default kosong jika tidak ada input
        $end_date = $request->input('end_date', ''); // Default kosong jika tidak ada input

        $packages = collect();
        if ($start_date && $end_date) {
            $packages = TravelPackage::with('galleries')
                ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])->get();
        }

        return view('pages.admin.report.travel-package.index', compact('start_date', 'end_date', 'packages'));
    }

    public function generatePackagePDF(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $packages = TravelPackage::with('galleries')
            ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])->get();

        $pdf = FacadePdf::loadView('pages.admin.report.travel-package.pdf', compact('packages', 'start_date', 'end_date'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_paket_perjalanan.pdf');
    }
}
