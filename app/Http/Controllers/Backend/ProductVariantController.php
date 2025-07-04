<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantDataTable $dataTable, Request $request)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.products.products-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.products-variant.create');
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

        $productVariant = new ProductVariant();

        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        notify()->success('Product Variant Created Successfully!');
        return redirect()->route('admin.products-variant.index', ['product' => $request->product]);
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
        $productVariant = ProductVariant::findOrFail($id);
        return view('admin.products.products-variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:100'],
                'status' => ['required'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $productVariant = ProductVariant::findOrFail($id);

        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        notify()->success('Product Variant Updated Successfully!');

        return redirect()->route(
            'admin.products-variant.index',
            ['product' => $productVariant->product_id]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productVariant = ProductVariant::findOrFail($id);

        $productVariantItemCheck = ProductVariantItem::where('product_variant_id', $productVariant->id)->exists();

        if ($productVariantItemCheck) {
            notify()->error('This Product Variant has items. Please delete them first!');
            return redirect()->back();
        }

        $productVariant->delete();

        notify()->success('Product Variant Deleted Successfully!');

        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $productVariant = ProductVariant::findOrFail($request->id);
        $productVariant->status = $request->status == 'true' ? 1 : 0;
        $productVariant->save();

        return response(['message' => 'Status has been updated!']);
    }
}
