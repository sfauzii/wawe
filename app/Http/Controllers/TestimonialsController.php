<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()


    {
        $items = TravelPackage::with('galleries')->latest()->get();

        $testimonies = Testimony::latest()->get();

        foreach ($items as $item) {
            $item = Testimony::whereHas('transactionDetail', function ($query) use ($item) {
                $query->where('travel_packages_id', $item->id);
            })->count();
            # code...
        }

        return view('pages.testimonials', [
            'items' => $items,
            'testimonies' => $testimonies,
        ]);
    }
}
