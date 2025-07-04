<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantItemDataTable $dataTable, $productId, $productVariantId)
    {
        $product = Product::findOrFail($productId);
        $productVariant = ProductVariant::findOrFail($productVariantId);
        return $dataTable->render('admin.products.products-variant-item.index', compact('product', 'productVariant'));
    }

    public function create(string $productId, string $productVariantId)
    {
        $product = Product::findOrFail($productId);
        $productVariant = ProductVariant::findOrFail($productVariantId);
        return view('admin.products.products-variant-item.create', compact('product', 'productVariant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'productVariant_id' => ['required', 'integer'],
                'name' => ['required', 'max:200'],
                'price' => ['required', 'integer'],
                'is_default' => ['required', 'boolean'],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $productVariantItem = new ProductVariantItem();

        $productVariantItem->product_variant_id = $request->productVariant_id;
        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;

        $productVariantItem->save();

        notify()->success('Product Variant Item Created Successfully!');

        return redirect()->route('admin.products-variant-item.index', [
            'productId' => $request->product_id,
            'productVariantId' => $request->productVariant_id
        ]);
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
    public function edit(string $productVariantId)
    {
        $productVariantItem = ProductVariantItem::findOrFail($productVariantId);
        return view('admin.products.products-variant-item.edit', compact('productVariantItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $productVariantItemId)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:200'],
                'price' => ['required', 'integer'],
                'is_default' => ['required', 'boolean'],
                'status' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $productVariantItem = ProductVariantItem::findOrFail($productVariantItemId);

        $productVariantItem->name = $request->name;
        $productVariantItem->price = $request->price;
        $productVariantItem->is_default = $request->is_default;
        $productVariantItem->status = $request->status;
        $productVariantItem->save();
        notify()->success('Product Variant Item Updated Successfully!');

        return redirect()->route('admin.products-variant-item.index', [
            // Here i am getting really assumed
            'productId' => $productVariantItem->productVariant->product_id,
            'productVariantId' => $productVariantItem->product_variant_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $variantItemId)
    {
        $productVariantItem = ProductVariantItem::findOrFail($variantItemId);

        $productVariantItem->delete();

        notify()->success('Product Variant Item Deleted Successfully!');
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $productVariantItem = ProductVariantItem::findOrFail($request->id);
        $productVariantItem->status = $request->status == 'true' ? 1 : 0;
        $productVariantItem->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
}
