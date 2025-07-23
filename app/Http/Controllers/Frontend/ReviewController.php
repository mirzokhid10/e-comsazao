<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\DataTables\UserProductReviewDataTable;
use App\Models\ProductReview;
use App\Models\ProductreviewGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use ImageUploadTrait;

    public function index(UserProductReviewDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.reviews.index');
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        // Check if user has a delivered order for this product
        $hasBought = \App\Models\Order::where([
            'user_id' => $user->id,
            'order_status' => 'delivered',
        ])->whereHas('orderProducts', function ($q) use ($productId) {
            $q->where('product_id', $productId);
        })->exists();

        if (!$hasBought) {
            notify()->error('Only customers who have purchased this product can leave a review.');
            return redirect()->back();
        }

        $request->validate([
            'rating' => ['required'],
            'review' => ['required', 'max:200'],
            'images.*' => ['image']
        ]);

        $checkReviewExist = ProductReview::where(['product_id' => $request->product_id, 'user_id' => Auth::user()->id])->first();
        if ($checkReviewExist) {
            notify()->error('You already added a review for this product!');
            return redirect()->back();
        }

        $imagePaths = $this->uploadMultiImage($request, 'images', 'uploads');

        $productReview = new ProductReview();
        $productReview->product_id = $request->product_id;
        $productReview->vendor_id = $request->vendor_id;
        $productReview->user_id = Auth::user()->id;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->status = 0;

        $productReview->save();

        if (!empty($imagePaths)) {

            foreach ($imagePaths as $path) {
                $reviewGallery = new ProductreviewGallery();
                $reviewGallery->product_review_id = $productReview->id;
                $reviewGallery->image = $path;
                $reviewGallery->save();
            }
        }

        notify()->success('Your review uploaded successfully!');

        return redirect()->back();
    }
}
