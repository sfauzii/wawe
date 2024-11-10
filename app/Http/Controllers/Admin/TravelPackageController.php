<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\Models\Testimony;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create package')->only(['create', 'store']);
        $this->middleware('check.permission:view package')->only('index');
        $this->middleware('check.permission:edit package')->only(['edit', 'update']);
        $this->middleware('check.permission:delete package')->only(['destroy']);
    }
    public function index()
    {
        $items = TravelPackage::with('galleries')->get();

        return view('pages.admin.travel-package.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.travel-package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelPackageRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Store the original price and calculate the discounted price
        $data['original_price'] = $data['price'];
        if ($request->discount_percentage > 0) {
            $data['price'] = $data['price'] - ($data['price'] * ($data['discount_percentage'] / 100));
        }

        TravelPackage::create($data);

        // Flash a success message to the session
        // Session::flash('success', 'Travel package created successfully.');
        Alert::success('Success', 'Travel package created successfully.');

        return redirect()->route('travel-package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $travelPackage = TravelPackage::findOrFail(decrypt($id));
        // Mengambil testimoni yang hanya terkait dengan paket perjalanan ini
        $testimonies = Testimony::where('travel_packages_id', $travelPackage->id)->with('user')->get();
        return view('pages.admin.travel-package.show', compact('travelPackage', 'testimonies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = TravelPackage::findOrFail(decrypt($id));

        return view('pages.admin.travel-package.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelPackageRequest $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = TravelPackage::findOrFail(decrypt($id));

        // Only include price-related fields if they are actually being updated
        if ($request->has('price')) {
            $data['original_price'] = $request->price; // Store new price as original

            if ($request->has('discount_percentage')) {
                // Calculate discounted price if there's a discount
                if ($request->discount_percentage > 0) {
                    $data['price'] = $request->price - ($request->price * ($request->discount_percentage / 100));
                } else {
                    $data['price'] = $request->price;
                }
            } elseif ($item->discount_percentage > 0) {
                // If price is updated but discount isn't, apply existing discount
                $data['price'] = $request->price - ($request->price * ($item->discount_percentage / 100));
            }
        } else {
            // If price is not being updated, remove price-related fields from the update data
            unset($data['price']);
            unset($data['original_price']);

            // If only discount_percentage is updated, recalculate price based on existing original price
            if ($request->has('discount_percentage') && $request->discount_percentage != $item->discount_percentage) {
                $data['price'] = $item->original_price - ($item->original_price * ($request->discount_percentage / 100));
            }
        }


        $item->update($data);

        // Flash a success message to the session
        // Session::flash('success', 'Travel package updated successfully.');
        Alert::success('Success', 'Travel package updated successfully.');

        return redirect()->route('travel-package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = TravelPackage::findOrFail(decrypt($id));
        $item->delete();

        // Flash a success message to the session
        // Session::flash('success', 'Travel package deleted successfully.');
        Alert::success('Success', 'Travel package deleted successfully.');

        return redirect()->route('travel-package.index');
    }

    public function toggleStatus($id)
    {
        $item = TravelPackage::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();

        $status = $item->is_active ? 'activated' : 'deactivated';
        toast("Package successfully {$status}", 'success');

        return redirect()->route('travel-package.index');
    }
}
