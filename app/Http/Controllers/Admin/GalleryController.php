<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\GalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create gallery')->only(['create', 'store']);
        $this->middleware('check.permission:view gallery')->only('index');
        $this->middleware('check.permission:edit gallery')->only(['edit', 'update']);
        $this->middleware('check.permission:delete gallery')->only(['destroy']);
    }

    public function index()
    {
        $items = Gallery::with(['travel_package'])
            ->whereNull('deleted_at')
            ->get();

        $packages = TravelPackage::whereNull('deleted_at')
            ->withCount('galleries')
            ->get();

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
        // Gunakan whereNull('deleted_at') dan where('is_active', 1) untuk memastikan
        // hanya menampilkan paket travel yang aktif dan belum dihapus
        $travel_packages = TravelPackage::whereNull('deleted_at')
            ->where('is_active', 1)
            ->get();

        return view('pages.admin.gallery.create', [
            'travel_packages' => $travel_packages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        // Validate that images are present
        if (!$request->hasFile('images')) {
            Alert::error('Error', 'Please select at least one image to upload.');
            return redirect()->back();
        }

        // Validate if images array is not empty
        $images = $request->file('images');
        if (empty($images)) {
            Alert::error('Error', 'Please select at least one image to upload.');
            return redirect()->back();
        }

        try {
            // Get travel_packages_id from request
            $travelPackagesId = $request->input('travel_packages_id');
            $imagePaths = [];

            // Save each image and get its path
            foreach ($images as $image) {
                $path = $image->store('assets/gallery', 'public');
                $imagePaths[] = $path;
            }

            // Save data to database with image array
            Gallery::create([
                'travel_packages_id' => $travelPackagesId,
                'image' => $imagePaths,
            ]);

            Alert::success('Success', 'Gallery package created successfully.');
            return redirect()->route('gallery.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to upload images. Please try again.');
            return redirect()->back();
        }
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
        // Find the existing gallery item
        $item = Gallery::findOrFail(decrypt($id));

        // Handle new images
        $newImages = $request->file('images');
        $existingImages = $item->image; // Get existing images
        $imagePaths = [];

        // Process new images if provided
        if ($newImages) {
            foreach ($newImages as $image) {
                $path = $image->store('assets/gallery', 'public');
                $imagePaths[] = $path;
            }
        }

        // Merge new images with existing images
        $updatedImages = array_merge($existingImages, $imagePaths);

        // Prepare data for update
        $data = [
            'travel_packages_id' => $request->input('travel_packages_id'),
            'image' => $updatedImages
        ];

        // Update the gallery item
        $item->update($data);

        Alert::success('Success', 'Gallery package updated successfully.');
        // Session::flash('success', 'Gallery package updated successfully.');

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

    public function deleteImage(string $id, int $index)
    {
        // Decrypt and find the gallery item
        $item = Gallery::findOrFail(decrypt($id));

        // Get the array of images
        $images = $item->image;

        // Check if the index is valid
        if (isset($images[$index])) {
            // Remove image from storage
            $imagePath = $images[$index];
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            // Remove the image from the array using array_splice
            array_splice($images, $index, 1);

            // Only update the gallery item if there are still images left
            $item->update(['image' => $images]);

            Alert::success('Success', 'Image deleted successfully.');
        } else {
            Alert::error('Error', 'Invalid image index.');
        }

        return redirect()->back();
    }
}
