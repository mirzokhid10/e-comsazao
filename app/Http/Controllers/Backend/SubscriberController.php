<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsletterSubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newsletter;

class SubscriberController extends Controller
{
    public function index(NewsletterSubscriberDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriber.index');
    }


    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'message' => ['required']
        ]);

        $emails = NewsletterSubscriber::where('is_verified', 1)->pluck('email')->toArray();

        if (empty($emails)) {
            notify()->warning('No verified subscribers to send the newsletter to.');
            return redirect()->back();
        }

        Mail::to('support@sazao.com')
            ->bcc($emails)
            ->send(new Newsletter($request->subject, $request->message));

        notify()->success('Mail Has Been Sent');
        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id)->delete();

        notify()->success('Subscriber deleted successfully');
        return redirect()->back();
    }
}