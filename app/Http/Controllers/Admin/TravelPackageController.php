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
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(4);

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
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(4);

        $item = TravelPackage::findOrFail(decrypt($id));

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
