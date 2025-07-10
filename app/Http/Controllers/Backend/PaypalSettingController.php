<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PaypalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('admin.payment-settings.sections.paypal-setting');
    // }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'status' => ['required', 'integer'],
                'mode' => ['required', 'integer'],
                'country_name' => ['required', 'max:200'],
                'currency_name' => ['required', 'max:200'],
                'currency_rate' => ['required'],
                'client_id' => ['required'],
                'secret_key' => ['required']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        PaypalSetting::updateOrCreate(
            ['id' => $id],
            [
                'status' => $request->status,
                'mode' => $request->mode,
                'country_name' => $request->country_name,
                'currency_name' => $request->currency_name,
                'currency_rate' => $request->currency_rate,
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key,
            ]
        );

        notify()->success('PayPal Settings Updated Successfully :)');
        return redirect()->back();
    }

    
}
