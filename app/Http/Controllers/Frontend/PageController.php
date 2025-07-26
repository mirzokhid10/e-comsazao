<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\EmailConfiguration;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function about()
    {
        $about = About::first();
        return view('frontend.pages.about', compact('about'));
    }

    public function termsAndCondition()
    {
        $terms = TermsAndCondition::first();
        return view('frontend.pages.terms-and-conditions', compact('terms'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    // public function handleContactForm(Request $request)
    // {
    //     dd('Form Submitted Successfully');
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'email', 'max:255'],
    //         'subject' => ['required', 'string', 'max:255'],
    //         'message' => ['required', 'string', 'max:255'],
    //     ]);

    //     $setting = EmailConfiguration::first();

    //     try {
    //         Mail::to($setting->email)->send(new Contact($request->subject, $request->message, $request->email));
    //         notify()->success('Message Sent Successfully!');
    //     } catch (\Exception $e) {
    //         notify()->error('Failed to send message.');
    //         return redirect()->back()->withInput();
    //     }

    //     return redirect()->back();
    // }



    public function handleContactForm(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
        ]);

        $setting = EmailConfiguration::first();

        try {
            Mail::to($setting->email)->send(new Contact(
                $request->subject,
                $request->message,
                $request->email
            ));

            return response()->json([
                'status' => 'success',
                'message' => 'Message Sent Successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while sending your message.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}