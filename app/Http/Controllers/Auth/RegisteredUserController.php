<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteUserProfileRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Mail\EmailVerificationMail;
use App\Mail\NewUserAdminEmailNotification;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Service\UploadService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class RegisteredUserController extends Controller
{
    public UploadService $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(UserRegistrationRequest $request): RedirectResponse
    {
        try{
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'registered_at' => Carbon::now()
            ]);

            sendVerificationEmail($user);
            $admin_email = config('app.admin_email');
            Mail::to($admin_email)->queue(new NewUserAdminEmailNotification($user));
            //
            return redirect(route('verification.notice', ['encrypted_email' => Crypt::encrypt($user->email)]));
        }
        catch (Throwable $throwable){
            logger()->error($throwable->getMessage());
        }
        return redirect(route('register'))->with(['error' => 'Something went wrong,Please try again']);
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth-ui.auth.register');
    }

    public function verifyEmail(Request $request): Application|Redirector|RedirectResponse
    {
        try {
            $token = request('token');
            $decrypted_token = Crypt::decrypt($token);
            $data = explode("_", $decrypted_token);
            if (count($data) === 3) {
                $user = User::where('id', $data[0])->where('email', $data[1])->first();
                if ($user) {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->status = 'active';
                    $user->save();
                    return redirect(route('complete-registration', Crypt::encrypt($user->email)))
                        ->with(['success' => 'Email verified successfully,Please complete your Profile']);
                }
            }
        } catch (Throwable $throwable) {
            logger()->warning($throwable->getMessage());
        }
        return view('not-found', ['message' => 'Email verification token not valid']);
    }

    public function resendEmailVerification($id)
    {
        $user = User::whereId($id)->first();
        if ($user) {
            sendVerificationEmail($user);
            return redirect()->intended(route('verification.notice', ['encrypted_email' => Crypt::encrypt($user->email)]));
        }

    }


    public function completeRegistrationProfileView($encrypted_email): Application|Factory|\Illuminate\Contracts\View\View
    {
        try {
            $email = Crypt::decrypt($encrypted_email);
            $user = User::whereEmail($email)->first();

            if ($user) {
                return view('auth-ui.complete-registration', ['user' => $user, 'token' => $encrypted_email]);
            }
        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage());
        }
        return view('auth-ui.auth.login', ['error' => 'Please login to complete your profile']);
    }


    /**
     * @desc Store Profile Information
     * @param CompleteUserProfileRequest $request
     * @param $encrypted_email
     * @return Factory|\Illuminate\Contracts\View\View|Application|RedirectResponse
     */
    public function completeRegistrationProfile(CompleteUserProfileRequest $request, $encrypted_email): Factory|Application|\Illuminate\Contracts\View\View|RedirectResponse
    {
        try {
            $email = Crypt::decrypt($encrypted_email);
            $user = User::whereEmail($email)->first();
            if ($user) {
                if ($request->hasFile('profile_image')) {
                    $image = $request->file('profile_image');
                    $fileName = $this->uploadService->upload($image, 'profile-image', 100,null);
                    $user->name = $request->name;
                    $user->username = $request->username;
                    $user->profile_photo = $fileName;
                    $user->is_profile_complete = true;
                    $user->save();

                    $user = $user->refresh();
                    Mail::to($user->email)->queue(new WelcomeMail($user));

                    return redirect()->route('login')->with('success', 'Profile updated successfully,Process to login');
                }

                return view('auth-ui.complete-registration', ['user' => $user]);
            }
        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage());
        }
        return view('auth-ui.auth.login', ['error' => 'Please login to complete your profile']);
    }

}
