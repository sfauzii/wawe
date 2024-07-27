<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data transaksi terbaru
        $recentSales = $this->getRecentSales();

        $filter_revenue = $request->input('filter_revenue', 'today');
        $salesData = $this->calculateRevenueData($filter_revenue);

        // Filter untuk customers
        $filter_customers = $request->input('filter_customers', 'today');
        $customerData = $this->calculateCustomerData($filter_customers);

        // Filter untuk laporan
        $filter = $request->input('filter', 'today');
        $usersQuery = User::query();
        $transactionsQuery = Transaction::query();

        switch ($filter) {
            case 'today':
                $usersQuery->whereDate('created_at', Carbon::today());
                $transactionsQuery->whereDate('created_at', Carbon::today());
                break;
            case 'this_month':
                $usersQuery->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
                $transactionsQuery->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
                break;
            case 'this_year':
                $usersQuery->whereYear('created_at', date('Y'));
                $transactionsQuery->whereYear('created_at', date('Y'));
                break;
            default:
                break;
        }

        $userCount = $usersQuery->count();
        $transactionCount = $transactionsQuery->count();

        $labels = [];
        $userData = [];
        $transactionData = [];

        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FFCD56', '#C9CBCF', '#FF8A80', '#D4E157', '#BA68C8', '#90A4AE'];

        for ($i = 1; $i <= 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $userCountMonth = 0;
            $transactionCountMonth = 0;

            foreach ($usersQuery->get() as $user) {
                if ($user->created_at->month == $i) {
                    $userCountMonth++;
                }
            }

            foreach ($transactionsQuery->get() as $transaction) {
                if ($transaction->created_at->month == $i) {
                    $transactionCountMonth++;
                }
            }

            $labels[] = $month;
            $userData[] = $userCountMonth;
            $transactionData[] = $transactionCountMonth;
        }

        $datasets = [
            [
                'label' => 'Users',
                'data' => $userData,
                'backgroundColor' => '#FF6384',
            ],
            [
                'label' => 'Transactions',
                'data' => $transactionData,
                'backgroundColor' => '#36A2EB',
            ],
        ];

        // kembalikan view dengan data yang diperoleh
        return view('pages.admin.dashboard', [
            'filter' => $filter,
            'filter_revenue' => $filter_revenue,
            'filter_customers' => $filter_customers,
            'recent_sales' => $recentSales,
            'labels' => $labels,
            'datasets' => $datasets,
            'salesData' => $salesData,
            'userCount' => $userCount,
            'transactionCount' => $transactionCount,
            'customerData' => $customerData,
        ]);
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

    public function calculateRevenueData($filter_revenue)
    {
        $salesQuery = Transaction::query();

        switch ($filter_revenue) {
            case 'today':
                $salesQuery->whereDate('created_at', Carbon::today());
                break;
            case 'this_month':
                $salesQuery->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
                break;
            case 'this_year':
            default:
                $salesQuery->whereYear('created_at', date('Y'));
                break;
        }

        $totalSales = $salesQuery->sum('transaction_total'); // Total transaction

        $pastSalesQuery = transaction::where('created_at', '>=', Carbon::now()->subDays(30));
        $pastTotalSales = $pastSalesQuery->sum('transaction_total'); // Total transaction
        $previousPeriodSalesQuery = Transaction::where('created_at', '>=', Carbon::now()->subDays(60))->where('created_at', '<', Carbon::now()->subDays(30));
        $previousPeriodTotalSales = $previousPeriodSalesQuery->sum('transaction_total');

        $increaseDecrease = $pastTotalSales - $previousPeriodTotalSales;
        $percentageChange = $previousPeriodTotalSales > 0 ? ($increaseDecrease / $previousPeriodTotalSales) * 100 : 0;

        return [
            'totalSales' => $totalSales,
            'increaseDecrease' => $increaseDecrease,
            'percentageChange' => $percentageChange,
        ];
    }

    public function calculateCustomerData($filter_customers)
    {
        $customersQuery = User::query();

        switch ($filter_customers) {
            case 'today':
                $customersQuery->whereDate('created_at', Carbon::today());
                break;
            case 'this_month':
                $customersQuery->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
                break;
            case 'this_year':
            default:
                $customersQuery->whereYear('created_at', date('Y'));
                break;
        }

        $currentCustomerCount = $customersQuery->count();

        // Calculate customer count for the past 30 days
        $pastCustomersQuery = User::where('created_at', '>=', Carbon::now()->subDays(30));
        $pastCustomerCount = $pastCustomersQuery->count();
        $previousPeriodCustomersQuery = User::where('created_at', '>=', Carbon::now()->subDays(60))->where('created_at', '<', Carbon::now()->subDays(30));
        $previousPeriodCustomerCount = $previousPeriodCustomersQuery->count();

        $increaseDecrease = $currentCustomerCount - $previousPeriodCustomerCount;
        $percentageChange = $previousPeriodCustomerCount > 0 ? ($increaseDecrease / $previousPeriodCustomerCount) * 100 : 0;

        return [
            'currentCustomerCount' => $currentCustomerCount,
            'increaseDecrease' => $increaseDecrease,
            'percentageChange' => $percentageChange,
        ];
    }
}
