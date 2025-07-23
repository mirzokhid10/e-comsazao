<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlistProducts = WishList::with('product')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('frontend.pages.wishlist', compact('wishlistProducts'));
    }

    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response(['status' => 'error', 'message' => 'Login Before Add A Product Into Wishlist!']);
        }

        $wishlistCount = WishList::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();
        if ($wishlistCount > 0) {
            return response(['status' => 'error', 'message' => 'The Product Is Already At Wishlist!']);
        }

        $wishlist = new WishList();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        $count = WishList::where('user_id', Auth::user()->id)->count();

        return response(['status' => 'success', 'message' => 'Product Added Into The Wishlist!', 'count' => $count]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wishlistProducts = WishList::where('id', $id)->firstOrFail();
        if ($wishlistProducts->user_id !== Auth::user()->id) {
            return redirect()->back();
        }
        $wishlistProducts->delete();

        notify()->success('Product Removed Successfully');

        return redirect()->back();
    }
}
