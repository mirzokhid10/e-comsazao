<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }

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
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/userProfileImage'), $imageName);

            $path = "/uploads/userProfileImage/" . $imageName;

            $user->image = $path;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        notify()->success('Profile Information Updated Successfully !');

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
