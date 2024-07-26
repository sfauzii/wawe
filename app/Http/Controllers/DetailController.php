<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Models\TravelPackage;

class DetailController extends Controller
{


    public function index(Request $request, $slug) {

        $item = TravelPackage::with(['galleries'])
            ->where('slug', $slug)
            ->firstOrFail();

        $testimonies = Testimony::with('user')
            ->whereHas('transactionDetail', function ($query) use ($item) {
                $query->where('travel_packages_id', $item->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

            $testimoniesCount =$testimonies->count();

        return view('pages.detail', [
            'item' => $item,
            'testimonies' => $testimonies,
            'testimoniesCount' => $testimoniesCount,
        ]);
    }
}
