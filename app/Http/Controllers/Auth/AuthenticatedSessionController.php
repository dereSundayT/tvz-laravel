<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginLog;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth-ui.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Application|Redirector|RedirectResponse
    {
        try{
            $request->authenticate();
            $user = auth()->user();
            if($user){
                $encrypted_email =  Crypt::encrypt($user->email);
                //:: Check if email is verified
                if($user->email_verified_at === null) {
                    sendVerificationEmail($user);
                    $this->destroy($request);
                    return redirect(route('verification.notice', ['encrypted_email' =>$encrypted_email]));
                }

                //:: Check if profile is complete
                if(!$user->is_profile_complete) {
                    $this->destroy($request);
                    return redirect(route('complete-registration', ['encrypted_email' =>$encrypted_email]));
                }

                $request->session()->regenerate();

                $this->storeLoginActivity($request,$user);

                return redirect(route('panel.home'));
            }
        }
        catch (\Throwable $throwable){
            logger()->error($throwable->getMessage());
        }
        return redirect(route('login'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    /**
     * Store Login Activity
     * @param Request $request
     * @param $user
     * @return true
     */
    protected function storeLoginActivity(Request $request, $user): true
    {
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $host = $request->header('Host');
        $referer = $request->header('Referer');
        LoginLog::create([
            'user_id' => $user->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'host' => $host,
            'referer' => $referer,
        ]);

        auth()->user()->update(['last_login_at' => now()]);
        return true;
    }
}
