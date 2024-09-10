<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = Carousel::all();

        return view('pages.admin.carousels.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(('pages.admin.carousels.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image_carousel' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'title_carousel' => 'required|string|max:255',
            'description_carousel' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image_carousel')) {
            $imageCarousel = $request->file('image_carousel');

            $imagePath = $imageCarousel->store('carousels', 'public');
            $validatedData['image_carousel'] = $imagePath;
        }

        Carousel::create($validatedData);

        Alert::success('Success', 'Hore kamu berhasil menambahkan carousel');

        return redirect()->route('carousels.index');
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
        $carousel = Carousel::findOrFail($id);

        return view('pages.admin.carousels.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carousel $carousel)
    {
        $validatedData = $request->validate([
            'image_carousel' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'title_carousel' => 'required|string|max:255',
            'description_carousel' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image_carousel')) {
            if ($carousel->image_carousel && Storage::exists('public/' . $carousel->image_carousel)) {
                Storage::delete('public/' . $carousel->image_carousel);
            }

            $imageCarousel = $request->file('image_carousel');
            $imagePath  = $imageCarousel->store('carousels', 'public');
            $validatedData['image_carousel'] = $imagePath;
        } else {
            $validatedData['image_carousel'] = $carousel->image_carousel;
        }

        $carousel->update($validatedData);

        Alert::success('Success', 'Horeee!! Kamu berhasil menambahkan carousel.');

        return redirect()->route('carousels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        $carousel->delete();

        toast('Carousel deleted successfully!', 'success');

        return redirect()->route('carousels.index');
    }

    public function toggleStatus($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->is_active = !$carousel->is_active;
        $carousel->save();

        toast('Carousel successfully is active', 'success');

        return redirect()->route('carousels.index');
    }
}
