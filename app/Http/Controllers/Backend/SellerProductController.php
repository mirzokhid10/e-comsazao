<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerProductsDataTable;
use App\DataTables\SellerPendingProductsDataTable;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SellerProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.products.seller-products.index');
    }

    public function pendingProducts(SellerPendingProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.products.seller-pending-products.index');
    }

    public function changeApproveStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();

        notify()->success('Product Approve Status Has Been Changed', 'Success');
        return response(['message' => 'Product Approve Status Has Been Changed']);
    }
}
