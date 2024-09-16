<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    //
    public function loginView(): Application|View|Factory|RedirectResponse
    {
        try{
            return view('admin.auth.admin-login');
        }
        catch (\Throwable $throwable){
            logger()->error($throwable->getMessage());
            return redirect()->back()->with('error', 'Unable to process request. Please try again later.');
        }

    }

    public function login(AdminLoginRequest $request)
    {
        try{

            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.users');
            }

            return redirect()->back()->with('error', 'Invalid credentials. Please try again.')->withInput($request->only('email'));
        }
        catch (\Throwable $throwable){
            return $throwable;
            logger()->error($throwable->getMessage());
            return redirect()->back()->with('error', 'Unable to process request. Please try again later.');
        }
    }

    public function adminLogout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
