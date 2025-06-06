<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();

        if (get_frontend_settings('recaptcha_status') == true && check_recaptcha($input['g-recaptcha-response']) == false) {

            Session::flash('error', get_phrase('Recaptcha verification failed'));

            return redirect()->back();
        }
        
        // validate email
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers',
        ]);

        // check user exists or not
        if (NewsletterSubscriber::where('email', $request->email)->exists()) {
            Session::flash('error', get_phrase('You have already subscribed.'));
            return redirect()->back();
        }

        // store data
        $data['email'] = $request->email;
        NewsletterSubscriber::insert($data);

        // redirect back
        Session::flash('success', get_phrase('You have successfully subscribed.'));
        return redirect()->back();
    }
}
