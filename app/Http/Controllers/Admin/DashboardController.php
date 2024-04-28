<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai filter dari request
        $filter = $request->input('filter');

        // Ambil data transaksi berdasarkan filter dan status SUCCESS
        $transactions = Transaction::where('transaction_status', 'SUCCESS');

        switch ($filter) {
            case 'today':
                $transactions->whereDate('created_at', Carbon::today());
                break;
            case 'this_month':
                $transactions->whereMonth('created_at', Carbon::now()->month);
                break;
            case 'this_year':
                $transactions->whereYear('created_at', Carbon::now()->year);
                break;
            // Tambahkan kasus lainnya jika perlu
            default:
                // Tidak ada filter yang dipilih, ambil semua transaksi
                break;
        }

        // Ambil data travel package
        $travelPackages = TravelPackage::count();

        // Ambil total transaksi
        $totalTransaction = $transactions->sum('transaction_total');

        // Ambil jumlah customers
        $customers = $transactions->count();

        // Ambil data untuk chart hanya untuk transaksi yang SUCCESS
        $chartData = $this->getChartData($transactions);

        // Ambil data recent sales
        $recentSales = $this->getRecentSales();

        // Kembalikan view dengan data yang diperoleh
        return view('pages.admin.dashboard', [
            'travel_package' => $travelPackages,
            'transaction' => $transactions->count(),
            'transaction_total' => $totalTransaction,
            'customers' => $customers,
            'filter' => $filter,
            'sales_data' => $chartData['sales_data'],
            'revenue_data' => $chartData['revenue_data'],
            'customer_data' => $chartData['customer_data'],
            'chart_categories' => $chartData['chart_categories'],
            'recent_sales' => $recentSales,
        ]);
    }

    public function getChartData($transactions)
    {
        // Ambil data untuk chart hanya untuk transaksi yang SUCCESS
        $sales_data = $transactions->pluck('id');
        $revenue_data = $transactions->pluck('transaction_total');
        $customer_data = $transactions->pluck('transaction_status');
        $chart_categories = $transactions->pluck('created_at');

        // Return data chart dalam bentuk array
        return [
            'sales_data' => $sales_data,
            'revenue_data' => $revenue_data,
            'customer_data' => $customer_data,
            'chart_categories' => $chart_categories,
        ];
    }

    public function getRecentSales()
    {
        // Ambil data transaksi terbaru tanpa membatasi status
        $recentSales = Transaction::latest()
            ->with('user')
            ->take(5) // Ambil lima data terbaru
            ->get();

        return $recentSales;
    }
}
