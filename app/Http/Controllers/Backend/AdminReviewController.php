<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(AdminReviewDataTable $datatable)
    {
        return $datatable->render('admin.products.reviews.index');
    }

    public function changeStatus(Request $request)
    {
        $review = ProductReview::findOrFail($request->id);
        $review->status = $request->status == 'true' ? 1 : 0;
        $review->save();

        notify()->success('Status Has Been Changed Successfully');
        return redirect()->back();
    }
}
