<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request,$encrypted_email): RedirectResponse|View
    {
        try{
            if($request->user() && !$request->user()->hasVerifiedEmail()){
                return redirect()->intended(route('dashboard', absolute: false));
            }
            $email = Crypt::decrypt($encrypted_email);
            $user =  User::where('email', $email)->first();

            if($user){
                return  view('auth-ui.auth.verify-email',['user'=>$user]);
            }

        }catch (\Throwable $throwable){
            logger()->error($throwable->getMessage());
        }
        return view('not-found',['message'=>'Unable to find user with that token.']);
    }
}
