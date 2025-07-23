<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\VendorProductReviewDataTable;
use Illuminate\Http\Request;

class VendorProductReviewController extends Controller
{
    public function index(VendorProductReviewDataTable $dataTable)
    {
        return $dataTable->render('vendor.reviews.index');
    }
}