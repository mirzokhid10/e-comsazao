<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        $content = TermsAndCondition::first();
        return view('admin.terms-and-conditions.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);

        TermsAndCondition::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );

        notify()->success('Terms and Conditions Updated Successfully!');

        return redirect()->back();
    }
}