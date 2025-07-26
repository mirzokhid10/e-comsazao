<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VendorConditions;
use Illuminate\Http\Request;

class VendorConditionController extends Controller
{
    public function index()
    {
        return view('admin.vendor-condition.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);

        VendorConditions::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );

        notify()->success('Vendor Condition Updated Successfully!');

        return redirect()->back();
    }
}