<?php

namespace App\Http\Controllers;

use App\Mail\Welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $toEmail='psvali000@gmail.com';
        $moreUser='sheksha357@gmail.com';
        $message='Welcome  to our Laravel application! This is a test email sent from the EmailController.';
        $subject='Welcome to Laravel';
        $details = [
            'name' => 'product 1',
            'product' => 'laptop',
            'cost' => '1000$',
        ];

        $request=Mail::to($toEmail)->cc($moreUser)->send(new Welcomeemail($message, $subject,$details));
        dd($request);
    }
    public function contact()
    {
        return view('contact');
    }
}
