<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\UploadService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Hash;

class UserPanelController extends Controller
{

    public function __construct(public UploadService $uploadService){}


    /**
     *
     */
    public function getFollowers()
    {
        try {
            $user = auth()->user();
            $user = User::where('id', $user->id)->first();
            $followers = $user->followers()->paginate(10);
            return view('user-panel.home.followers', ['user' => $user,'followers' => $followers]);
        } catch (Throwable $throwable) {
        }
    }

    public function  getUserFollowing(): Application|Factory|View
    {
        $user = auth()->user();
        $user = User::where('id', $user->id)->first();
        $following = $user->following()->paginate(10);
        return view('user-panel.home.following', ['user' => $user,'following' => $following]);
    }


    /**
     * Upload Profile Image to storage/app/public
     * Update Profile , Set Bio Message
     * Change Password
     * Set Profile Public or Private (Private profile can only be viewed by followers)
     * Logout
     *
     */
    public function profile()
    {
        try {
            $user = auth()->user();
            return view('user-panel.profile', ['user' => $user]);
        } catch (Throwable $throwable) {
        }
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function changePassword(Request $request): RedirectResponse
    {
        try {
            $user = auth()->user();
            // Validate the request input
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed|min:8'
            ]);

            // Checking if the old password matches the current password
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Your old password does not match our records.');
            }

            $user->update(['password' => Hash::make($request->password)]);
            // Return success response
            return redirect()->back()->with('success', 'Password changed successfully!');
        } catch (Throwable $throwable) {
            // Log the error message
            logger()->error($throwable->getMessage());
            // Return an error response
            return redirect()->back()->with('error', $throwable->getMessage());
        }
    }


    /**
     * @desc Update Basic Information
     * @param Request $request
     * @return RedirectResponse
     */

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'about_me' => ['required', 'string', 'max:255'],
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $fileName = $user->profile_photo;

            //profile-image
            if ($request->hasFile('profile_photo')) {
                $image = $request->file('profile_photo');
                $fileName = $this->uploadService->upload($image, 'profile-image', 100, $user->profile_photo);
            }

            Auth::user()->update(['name' => $request->name, 'profile_photo' => $fileName, 'about_me' => $request->about_me]);

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage());
//            return $throwable;
        }
        return redirect()->back()->with('error', $throwable->getMessage());
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeProfileMode(Request $request)
    {
        try {
            $request->validate(['is_private_profile' => ['required']]);



            $profileMode = $request->input('is_private_profile');
//            return $profileMode;
            Auth::user()->update(['is_private_profile' => $profileMode]);

            return redirect()->back()->with('success', 'Profile mode updated successfully.');
        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage());
        }
        return redirect()->back()->with('error', $throwable->getMessage());
    }








}
