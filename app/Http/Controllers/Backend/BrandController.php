<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'logo' => ['required', 'image', 'max:2046'],
                'name' => ['required', 'string', 'max:100'],
                'is_featured' => ['required'],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $imagePath = $this->uploadImage($request, 'logo', 'uploads');

        $brand = new Brand();

        $brand->logo = $imagePath;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;

        $brand->save();

        notify()->success('Category Information Created Successfully!');

        return redirect()->route('admin.brand.index');
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
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'logo' => ['required', 'image', 'max:2046'],
                'name' => ['required', 'string', 'max:100'],
                'is_featured' => ['required'],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $brand = Brand::findOrFail($id);

        $imagePath = $this->updateImage($request, 'logo', 'uploads');

        $brand->logo = $imagePath;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;

        $brand->logo = empty(!$imagePath) ? $imagePath : $brand->logo;

        Cache::forget('brands');

        $brand->save();

        notify()->success('Brand Information Edited Successfully!');

        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        if (Product::where('brand_id', $brand->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'This brand have products you can\'t delete it.']);
        }
        $this->deleteImage($brand->logo);
        $brand->delete();

        notify()->success('Brand Information Deleted Successfully!');

        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();

        // return notify()->success('Category Status Changed Successfully!');
        return response()->json(['message' => 'Brand Status Changed Successfully!']);
    }
}
