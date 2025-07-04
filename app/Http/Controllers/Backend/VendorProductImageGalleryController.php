<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductImageGalleriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductImageGalleriesDataTable $dataTable, Request $request)
    {
        $product = Product::findOrFail($request->product);
        if ($product->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        return $dataTable->render('vendor.products.image-gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image.*' => ['required', 'image', 'max:2048']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please upload at least one image before submitting..');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        /** Handle image upload */
        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads');

        foreach ($imagePaths as $path) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->image = $path;
            $productImageGallery->product_id = $request->product;
            $productImageGallery->save();
        }

        notify()->success('Product Images Have Been Added Successfully!');
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productImage = ProductImageGallery::findOrFail($id);
        if ($productImage->product->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        $this->deleteImage($productImage->image);
        $productImage->delete();

        notify()->success('Product Image Has Been Deleted Successfully!');
        return redirect()->back();
    }
}
