<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    public function index($username, $id)
    {
        // Pastikan pengguna yang login sesuai dengan username yang diminta
        if (Auth::user()->username !== $username) {
            return redirect()->route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]);
        }

        // Ambil data pengguna berdasarkan username dan id
        $user = User::where('username', $username)->where('id', $id)->firstOrFail();

        // $totalIncome = Transaction::where('users_id', $user->id)
        // ->where('transaction_status', 'SUCCESS')  // Assuming 'success' is the status indicating a successful transaction
        // ->sum('transaction_total');

        // Current period (e.g., current month)
        $startDateCurrent = Carbon::now()->startOfMonth();
        $endDateCurrent = Carbon::now()->endOfMonth();

        // Previous period (e.g., previous month)
        $startDatePrevious = Carbon::now()->subMonth()->startOfMonth();
        $endDatePrevious = Carbon::now()->subMonth()->endOfMonth();

        // Query for current period
        $currentData = Transaction::select(DB::raw('SUM(transaction_total) as total_income'), DB::raw('COUNT(*) as total_tickets'))
            ->where('users_id', $user->id)
            ->where('transaction_status', 'SUCCESS')
            ->whereBetween('created_at', [$startDateCurrent, $endDateCurrent])
            ->first();

        $currentIncome = $currentData->total_income ?? 0;
        $currentTickets = $currentData->total_tickets ?? 0;

        // Query for previous period
        $previousData = Transaction::select(DB::raw('SUM(transaction_total) as total_income'), DB::raw('COUNT(*) as total_tickets'))
            ->where('users_id', $user->id)
            ->where('transaction_status', 'SUCCESS')
            ->whereBetween('created_at', [$startDatePrevious, $endDatePrevious])
            ->first();

        $previousIncome = $previousData->total_income ?? 0;
        $previousTickets = $previousData->total_tickets ?? 0;

        // Calculate percentage changes
        $incomeChange = $this->calculatePercentageChange($previousIncome, $currentIncome);
        $ticketsChange = $this->calculatePercentageChange($previousTickets, $currentTickets);

        return view('pages.users.overview', [
            'user' => $user,
            'totalIncome' => $currentIncome,
            'totalTickets' => $currentTickets,
            'incomeChange' => $incomeChange,
            'ticketsChange' => $ticketsChange,
        ]);
    }

    private function calculatePercentageChange($previous, $current)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0; // Handle case where there were no transactions previously
        }
        return (($current - $previous) / $previous) * 100;
    }
}
