<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $items = TravelPackage::with('galleries')
            ->withCount('transactions') // Hitung jumlah transaksi
            // ->where('kuota', '>', 0) // Tampilkan hanya paket yang memiliki kuota
            ->where('is_active', true)
            ->orderBy('transactions_count', 'desc') // Urutkan berdasarkan jumlah transaksi terbanyak
            ->take(4) // Ambil 4 travel package teratas
            ->get();

        // Ambil 4 testimonies secara random
        $testimonies = Testimony::inRandomOrder()->take(4)->get();

        foreach ($items as $item) {
            $item->testimonies_count = Testimony::whereHas('transactionDetail', function ($query) use ($item) {
                $query->where('travel_packages_id', $item->id);
            })->count();
        }


        $totalTestimonies = Testimony::count();

        return view('pages.home', [
            'items' => $items,
            'testimonies' => $testimonies,
            'totalTestimonies' => $totalTestimonies,
        ]);
    }
}
