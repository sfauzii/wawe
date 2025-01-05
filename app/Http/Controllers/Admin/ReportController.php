<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Models\TransactionDetail;
use App\Exports\TravelPackageExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionDataExport;
use App\Exports\TransactionDetailsExport;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ReportController extends Controller


{
    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create report package')->only('generatePackagePDF');
        $this->middleware('check.permission:view report package')->only('showFormPackage');
        $this->middleware('check.permission:create report transaction')->only('generatePDF');
        $this->middleware('check.permission:view report transaction')->only('showFormTransaction');
    }

    public function showFormTransaction(Request $request)
    {
        // Validasi rentang tanggal
        if ($request->filled(['start_date', 'end_date'])) {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ], [
                'end_date.after_or_equal' => 'Start date cannot be greater than end date.'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $startDate = $request->input('start_date', '');
        $endDate = $request->input('end_date', '');

        $transactions = collect();
        if ($startDate && $endDate) {
            $transactions = Transaction::whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])
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

        // Validasi rentang tanggal
        if ($request->filled(['start_date', 'end_date'])) {
            $validator = Validator::make($request->all(), [
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ], [
                'end_date.after_or_equal' => 'Start date cannot be greater than end date.'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }


        $start_date = $request->input('start_date', ''); // Default kosong jika tidak ada input
        $end_date = $request->input('end_date', ''); // Default kosong jika tidak ada input

        $packages = collect();
        $packages = collect();
        if ($start_date && $end_date) {
            $packages = TravelPackage::with(['galleries', 'transactions'])
                // Filter transaksi dengan status 'SUCCESS' sebelum menghitung agregat
                ->withCount(['transactions as sales' => function ($query) {
                    $query->where('transaction_status', 'SUCCESS');
                }])
                // Agregat hanya transaksi yang statusnya 'SUCCESS'
                ->withSum(['transactions as total_grand_total' => function ($query) {
                    $query->where('transaction_status', 'SUCCESS');
                }], 'grand_total')
                ->withAvg(['transactions as avg_grand_total' => function ($query) {
                    $query->where('transaction_status', 'SUCCESS');
                }], 'grand_total')
                ->withMax(['transactions as max_grand_total' => function ($query) {
                    $query->where('transaction_status', 'SUCCESS');
                }], 'grand_total')
                ->withMin(['transactions as min_grand_total' => function ($query) {
                    $query->where('transaction_status', 'SUCCESS');
                }], 'grand_total')
                ->withCount(['transactions as total_transaction' => function ($query) {
                    $query->where('transaction_status', 'SUCCESS');
                }])
                ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                ->get();
        }
        return view('pages.admin.report.travel-package.index', compact('start_date', 'end_date', 'packages'));
    }

    public function generatePackagePDF(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Ambil paket perjalanan dengan jumlah penjualan dan total nilai dalam Rupiah
        $packages = TravelPackage::with(['galleries'])
            ->withCount(['transactions as sales' => function ($query) {
                $query->where('transaction_status', 'SUCCESS');
            }])
            ->withSum(['transactions as total_sales_rupiah' => function ($query) {
                $query->where('transaction_status', 'SUCCESS');
            }], 'grand_total')
            ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
            ->get();

        $pdf = FacadePdf::loadView('pages.admin.report.travel-package.pdf', compact('packages', 'start_date', 'end_date'))->setPaper('a4', 'portrait');
        return $pdf->stream('laporan_paket_perjalanan.pdf');
    }


    public function generateTransactionDetailsPdf($transaction_id)
    {
        // Find the specific transaction with related data
        $transaction = Transaction::with(['user', 'details', 'travel_package'])
            ->where('transaction_status', 'SUCCESS')
            ->findOrFail($transaction_id);

        // Get the package and user data
        $package = $transaction->travel_package;
        $user = $transaction->user;

        // Calculate financial details
        $cost = $package->price;
        $profitOrLoss = $transaction->grand_total - $cost;

        // Get transaction details
        $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id)->get();

        // Count the number of users and calculate per user price
        $userCount = $transactionDetails->count();
        $pricePerUser = $package->price;

        // Calculate full payment (without any down payment)
        $fullPayment = $userCount * $pricePerUser;


        // Initialize remaining payments as null
        $remainingPayment = null;
        $remainingFullPayment = null;

        // Calculate remaining payment for down payment
        if ($transaction->payment_method === 'down_payment') {
            $remainingPayment = $fullPayment * 0.75; // Remaining 75%
            $remainingFullPayment = $remainingPayment; // Total remaining payment
        }

        // Prepare transaction details
        $transactionData = [
            'transaction_id' => $transaction->id,
            'transaction_date' => $transaction->created_at,
            'grand_total' => $transaction->grand_total,
            'cost' => $cost,
            'profit_or_loss' => $profitOrLoss,
            'customer_name' => $user->name ?? 'Unknown Customer',
            'payment_method' => $transaction->payment_method ?? 'Not Specified',
            'remainingFullPayment' => $remainingFullPayment,
            'details' => $transaction->details->map(function ($detail) {
                return [
                    'username' => $detail->username,
                    'phone' => $detail->phone,
                    // Add other fields as needed
                ];
            })
        ];

        // Pass data to the PDF view
        $pdf = FacadePdf::loadView('pages.admin.report.travel-package.package-details-pdf', [
            'package' => $package,
            'user' => $user,
            'transaction' => $transactionData,
        ]);

        return $pdf->download("Package_{$transaction_id}_Report.pdf");
    }

    public function generateTransactionDetailsExcel($transaction_id)
    {
        // Find the specific transaction with related data
        $transaction = Transaction::with(['user', 'details', 'travel_package'])
            ->where('transaction_status', 'SUCCESS')
            ->findOrFail($transaction_id);

        // Get the package and user data
        $package = $transaction->travel_package;
        $user = $transaction->user;

        // Calculate financial details
        $cost = $package->price;
        $profitOrLoss = $transaction->grand_total - $cost;

        // Get transaction details
        $transactionDetails = TransactionDetail::where('transactions_id', $transaction->id)->get();

        // Count the number of users and calculate per user price
        $userCount = $transactionDetails->count();
        $pricePerUser = $package->price;

        // Calculate full payment (without any down payment)
        $fullPayment = $userCount * $pricePerUser;

        // Initialize remaining payments as null
        $remainingPayment = null;
        $remainingFullPayment = null;

        // Calculate remaining payment for down payment
        if ($transaction->payment_method === 'down_payment') {
            $remainingPayment = $fullPayment * 0.75; // Remaining 75%
            $remainingFullPayment = $remainingPayment; // Total remaining payment
        }

        // Prepare transaction details
        $transactionData = [
            'transaction_id' => $transaction->id,
            'transaction_date' => $transaction->created_at,
            'grand_total' => $transaction->grand_total,
            'cost' => $cost,
            'profit_or_loss' => $profitOrLoss,
            'customer_name' => $user->name ?? 'Unknown Customer',
            'payment_method' => $transaction->payment_method ?? 'Not Specified',
            'remainingFullPayment' => $remainingFullPayment,
        ];

        return Excel::download(
            new TransactionDetailsExport($transaction, $package, $user, $transactionData),
            "Transaction_{$transaction_id}_Report.xlsx"
        );
    }

    // public function generatePackageDetailsExcelByUser($package_id, $user_id)
    // {
    //     $package = TravelPackage::with(['transactions' => function ($query) use ($user_id) {
    //         $query->where('transaction_status', 'SUCCESS')
    //             ->where('users_id', $user_id);
    //     }, 'transactions.user', 'transactions.details'])->findOrFail($package_id);

    //     $transactions = $package->transactions;

    //     if ($transactions->isEmpty()) {
    //         abort(404, 'No transactions found for the selected user.');
    //     }

    //     $user = $transactions->first()->user;

    //     // Calculate total revenue, total cost, profit/loss, and net profit
    //     $totalRevenue = $transactions->sum('grand_total');
    //     $totalCost = $package->price * $transactions->count();
    //     $netProfit = $totalRevenue - $totalCost;

    //     // Prepare detailed transaction data
    //     $transactionDetails = $transactions->map(function ($transaction) use ($package) {
    //         $cost = $package->price;
    //         $profitOrLoss = $transaction->grand_total - $cost;

    //         $details = $transaction->details->map(function ($detail) {
    //             return [
    //                 'username' => $detail->username,
    //                 'phone' => $detail->phone,
    //             ];
    //         });

    //         return [
    //             'Transaction Date' => $transaction->created_at->format('Y-m-d H:i:s'),
    //             'Customer Name' => $transaction->user ? $transaction->user->name : 'Unknown Customer',
    //             'Grand Total' => $transaction->grand_total,
    //             'Cost' => $cost,
    //             'Profit/Loss' => $profitOrLoss,
    //             'Payment Method' => $transaction->payment_method ?? 'Not Specified',
    //             'Details' => $details->toArray(),
    //         ];
    //     });

    //     // Prepare data for Excel
    //     $data = $transactionDetails->toArray();
    //     $summary = [
    //         ['Total Revenue', $totalRevenue],
    //         ['Total Cost', $totalCost],
    //         ['Net Profit', $netProfit],
    //     ];

    //     $fileName = "Customer_{$user->name}_PackageDetailsReport.xlsx";

    //     return Excel::download(new class($data, $summary) implements \Maatwebsite\Excel\Concerns\FromArray {
    //         protected $data;
    //         protected $summary;

    //         public function __construct($data, $summary)
    //         {
    //             $this->data = $data;
    //             $this->summary = $summary;
    //         }

    //         public function array(): array
    //         {
    //             return array_merge(
    //                 [['Report Summary'], $this->summary, [''], ['Transaction Details']],
    //                 $this->data
    //             );
    //         }
    //     }, $fileName);
    // }

    public function generatePackageExcel(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        return Excel::download(new TravelPackageExport($start_date, $end_date), 'laporan_paket_perjalanan.xlsx');
    }


    function genereteTransactionExcel(Request $request) //+
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Format the filename with the period range
        $fileName = 'transaction_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new TransactionDataExport($startDate, $endDate), $fileName);
    }
}
