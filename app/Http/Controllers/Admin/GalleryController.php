<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\GalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Gallery::with(['travel_package'])->get();

        $packages = TravelPackage::withCount('galleries')->get();

        return view('pages.admin.gallery.index', [
            'items' => $items,
            'packages' => $packages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $travel_packages = TravelPackage::all();
        return view('pages.admin.gallery.create', [
            'travel_packages' => $travel_packages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('assets/gallery', 'public');

        Gallery::create($data);

        // Session::flash('success', 'Gallery package created successfully.');
        Alert::flash('Success', 'Gallery package created successfully.');
        
        return redirect()->route('gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Gallery::findOrfail(decrypt($id));
        $travel_packages = TravelPackage::all();

        return view('pages.admin.gallery.edit', [
            'item' => $item,
            'travel_packages' => $travel_packages,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, string $id)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('assets/gallery', 'public');

        $item = Gallery::findOrFail(decrypt($id));

        $item->update($data);

        // Session::flash('success', 'Gallery package updated successfully.');
        Alert::success('Success', 'Gallery package updated successfully');

        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Gallery::findOrFail(decrypt($id));
        $item->delete();

        // Session::flash('success', 'Gallery package created successfully.');
        Alert::success('Success', 'Gallery package created successfully');
        
        return redirect()->route('gallery.index');
    }
}
