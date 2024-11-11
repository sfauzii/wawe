<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Models\TravelPackage;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = TravelPackage::with('galleries')
            ->where('is_active', true);

        // Sorting Logic
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'baru_rilis':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'murah':
                    $query->orderBy('price', 'asc');
                    break;
                case 'harga-tertinggi':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    break;
            }
        }

        $query->orderBy('created_at', 'desc');

        $items = $query->get();

        foreach ($items as $item) {
            $item->testimonies_count = Testimony::whereHas('transactionDetail', function ($query) use ($item) {
                $query->where('travel_packages_id', $item->id);
            })->count();
        }

        return view('pages.catalog', [
            'items' => $items,
        ]);
    }
}
