<?php

use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

function sendVerificationEmail($user): true
{
    $time = time();
    $verification_key = Crypt::encrypt("{$user->id}_{$user->email}_{$time}");
    $verification_link = config('app.url')."/verify-email?token=$verification_key";

    $emailData = [
        'name'=>'User',
        'verification_link'=>$verification_link
    ];

    Mail::to($user->email)->queue(new EmailVerificationMail($emailData));
    return true;
}


