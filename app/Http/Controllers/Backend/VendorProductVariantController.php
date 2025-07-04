<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductVariantDataTable $dataTable, Request $request)
    {
        $product = Product::findOrFail($request->product);

        /** Check product vendor */
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        return $dataTable->render(
            'vendor.products.products-variant.index',
            compact('product')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::findOrFail(request()->product);
        return view(
            'vendor.products.products-variant.create',
            compact('product')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product' => ['integer', 'required'],
                'name' => ['required', 'max:200'],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $vendorProductVariant = new ProductVariant();

        $vendorProductVariant->product_id = $request->product;
        $vendorProductVariant->name = $request->name;
        $vendorProductVariant->status = $request->status;

        $vendorProductVariant->save();
        notify()->success('Product Variant Created Successfully!');

        return redirect()->route(
            'vendor.products-variant.index',
            ['product' => $request->product]
        );
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
        $vendorProductVariant = ProductVariant::findOrFail($id);

        /** Check product vendor */
        if ($vendorProductVariant->product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        return view(
            'vendor.products.products-variant.edit',
            compact('vendorProductVariant')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:200'],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $vendorProductVariant = ProductVariant::findOrFail($id);

        /** Check product vendor */
        if ($vendorProductVariant->product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        $vendorProductVariant->name = $request->name;
        $vendorProductVariant->status = $request->status;

        $vendorProductVariant->save();

        notify()->success('Product Variant Updated Successfully!');
        return redirect()->route(
            'vendor.products-variant.index',

            ['product' => $vendorProductVariant->product_id]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendorProductVariant = ProductVariant::findOrFail($id);

        $vendorProductVariant->delete();

        notify()->success('Product Variant Deleted Successfully!');
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $vendorProductVariant = ProductVariant::findOrFail($request->id);
        $vendorProductVariant->status = $request->status == 'true' ? 1 : 0;
        $vendorProductVariant->save();

        return response(['message' => 'Status has been updated!']);
    }
}
