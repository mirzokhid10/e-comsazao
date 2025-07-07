<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:100'],
                'code' => ['required', 'max:50'],
                'quantity' => ['required', 'integer', 'min:1'],
                'max_use' => ['required', 'integer', 'min:1'],
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date'],
                'discount_type' => ['required'],
                'discount' => ['required', 'numeric', 'min:0'],
                'status' => ['required', 'boolean']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $coupon = new Coupon();

        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity = $request->quantity;
        $coupon->max_use = $request->max_use;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;
        $coupon->total_used = 0; // Initialize total_used to 0
        $coupon->save();

        // Store the coupon logic here

        notify()->success('Coupon created successfully.');
        return redirect()->route('admin.coupon.index');
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
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:100'],
                'code' => ['required', 'max:50'],
                'quantity' => ['required', 'integer', 'min:1'],
                'max_use' => ['required', 'integer', 'min:1'],
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date'],
                'discount_type' => ['required'],
                'discount' => ['required', 'numeric', 'min:0'],
                'status' => ['required', 'boolean']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $coupon = Coupon::findOrFail($id);

        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity = $request->quantity;
        $coupon->max_use = $request->max_use;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;
        $coupon->save();
        notify()->success('Coupon updated successfully.');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        notify()->success('Coupon deleted successfully.');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Change the status of the coupon.
     */
    public function changeStatus(Request $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->status = $request->status == 'true' ? 1 : 0;
        $coupon->save();

        return response()->json(['message' => 'Coupon Status Changed Successfully!']);
    }
}
