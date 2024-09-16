<?php
namespace App\Http\Controllers\HomePage;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class HomeController extends Controller
{

    public function home()
    {
        $user = auth()->user();
        if($user){
            $users =User::whereStatus('active')
                ->whereNotNull('username')
                ->where('id','!=',$user->id)
                ->orderBy('created_at','desc')
                ->paginate(10)
            ;
        }
        else{
            $users = User::whereStatus('active')
                ->whereNotNull('username')
                ->where('is_private_profile',false)
                ->paginate(10);
        }

        return view('home.home',['users' => $users]);
    }

    public function  profilePage($username): Application|Factory|View
    {
        try{
            $user = User::whereUsername($username)->first();
            if($user){
                return view('home.profile', ['user' => $user]);
            }
        }
        catch (Throwable $throwable){
            logger("user $username not found")->warning($throwable->getMessage());
        }
        return view('not-found',['message'=>"The User you are looking for doesn't exist."]);
    }



    public function follow($id): RedirectResponse
    {
        $userToFollow = User::where('id', $id)->first();
        $currentUser = Auth::user();

        if($userToFollow && $currentUser){
            // Check if the user is already followed
            if ($currentUser->following()->where('followed_id', $userToFollow->id)->exists()) {
                return redirect()->back()->with('info', 'You are already following this user.');
            }

            // Follow the user
            $currentUser->following()->attach($userToFollow->id);

            return redirect()->back()->with('success', 'You are now following ' . $userToFollow->name);
        }

        return redirect()->back()->with('error', 'Invalid request');
    }



    // Unfollow a user
    public function unfollow($id): RedirectResponse
    {
        $currentUser = Auth::user();
        $userToUnfollow = User::where('id', $id)->first();
        if($userToUnfollow && $currentUser){
            // Check if the user is currently been followed
            if (!$currentUser->following()->where('followed_id', $userToUnfollow->id)->exists()) {
                return redirect()->back()->with('info', 'You are not following this user.');
            }
            // Unfollow the user
            $currentUser->following()->detach($userToUnfollow->id);
            return redirect()->back()->with('success', 'You have unfollowed ' . $userToUnfollow->name);
        }
        return redirect()->back()->with('error', 'Invalid request');
    }


}
