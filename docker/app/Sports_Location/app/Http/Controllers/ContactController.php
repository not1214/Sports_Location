<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function form()
    {
        return view('contact/form');
    }

    public function confirm(Request $request)
    {
        $data = $request->all();
        return view('contact.confirm', compact('data'));
    }

    public function send(Request $request)
    {
        if ($request->get('back')) {
            return redirect()->route('contact.form')->withInput();
        }

        Mail::send('emails.text', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body,
        ], function ($message) {
            $message->to(env('MAIL_USERNAME'))->subject('お問い合わせがありました。');
        });

        return redirect()->route('contact.complete');
    }

    public function complete()
    {
        return view('contact/complete');
    }
}
