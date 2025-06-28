<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class VendorProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }

    // public function updateProfile(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'name' => ['required', 'max:30'],
    //             'username' => ['required', 'max:30'],
    //             'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
    //             'phone' => ['required', 'max:30'],
    //             'image' => ['nullable', 'image', 'max:2048'],
    //         ]);
    //     } catch (ValidationException $e) {
    //         notify()->error('Please correct the form errors and try again.');
    //         return redirect()->back()
    //             ->withErrors($e->validator)
    //             ->withInput();
    //     }

    //     $user = Auth::user();

    //     if ($request->hasFile('image')) {
    //         if (File::exists(public_path($user->image))) {
    //             File::delete(public_path($user->image));
    //         }

    //         $image = $request->image;
    //         $imageName = rand() . '_' . $image->getClientOriginalName();
    //         $image->move(public_path('uploads/userProfileImage'), $imageName);

    //         $path = "/uploads/userProfileImage/" . $imageName;

    //         $user->image = $path;
    //     }

    //     $user->name = $request->name;
    //     $user->username = $request->username;
    //     $user->email = $request->email;
    //     $user->phone = $request->phone;
    //     $user->save();

    //     notify()->success('Profile Information Updated Successfully !');

    //     return redirect()->back();
    // }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:30'],
                'username' => ['required', 'max:30'],
                'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
                'phone' => ['required', 'max:30'],
                'image' => ['nullable', 'image', 'max:2048'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $user = Auth::user();

        // Store old values for comparison
        $hasChanges = false;

        // Check for text field changes
        if (
            $user->name !== $request->name ||
            $user->username !== $request->username ||
            $user->email !== $request->email ||
            $user->phone !== $request->phone
        ) {
            $hasChanges = true;

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
        }

        // Check for image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/userProfileImage'), $imageName);

            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $user->image = '/uploads/userProfileImage/' . $imageName;
            $hasChanges = true;
        }

        // Save only if changes exist
        if ($hasChanges) {
            $user->save();
            notify()->success('Profile Information Updated Successfully!');
        } else {
            notify()->info('No changes were made.');
        }

        return redirect()->back();
    }



    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed']
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please enter the correct password and try again.');
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        notify()->success('Profile Password Updated Successfully!');
        return redirect()->back();
    }
}
