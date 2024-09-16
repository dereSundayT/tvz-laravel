<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddUserRequest;
use App\Http\Requests\AdminUpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    /**
     * Get users with pagination
     */
    public function getUsers(): Application|View|Factory|RedirectResponse
    {
        try{
            //Select Certain Fields
            $users = User::select(['id', 'name', 'email', 'created_at','username','about_me','status'])
                ->where('status','!=', 'deleted')
                ->paginate(10);
            return view('admin.users.users', ['users' => $users]);
        }
        catch (\Throwable $throwable){
             Log::warning("Error while fetching users: " . $throwable->getMessage(),[
                 "Full Exception" => $throwable
             ]);
            return redirect()->back()->with('error', $throwable->getMessage());
        }
    }


    /**
     * @param AdminAddUserRequest $adminAddUserRequest
     * @return RedirectResponse
     */
    public function addUser(AdminAddUserRequest $adminAddUserRequest): RedirectResponse
    {
        try{
            User::create([
                'name' => $adminAddUserRequest->name,
                'email' => $adminAddUserRequest->email,
                'username' => $adminAddUserRequest->username,
                'password' => Hash::make($adminAddUserRequest->password),
                'about_me' => $adminAddUserRequest->about_me,
                'status' => $adminAddUserRequest->status,
            ]);
            return redirect()->back()->with('success', 'User added successfully');
        }
        catch (\Throwable $throwable){
            logger()->error($throwable->getMessage());
        }
        return redirect()->back()->with('error', 'Unable to create user');
    }


    /**
     * @desc : delete user
     * @param AdminUpdateUserRequest $adminUpdateUserRequest
     * @param $user_id
     * @return RedirectResponse
     */
    public function updateUser(AdminUpdateUserRequest $adminUpdateUserRequest,$user_id): RedirectResponse
    {
        try{
            $user = User::where('id',$user_id)->first();
            if($user){
                $user->update([
                    'status' => $adminUpdateUserRequest->status,
                    'name'  => $adminUpdateUserRequest->name
                ]);
                return redirect()->back()->with('success', 'User updated successfully');
            }
            return redirect()->back()->with('error', 'User not found');
        }
        catch (\Throwable $throwable){
            logger()->error($throwable->getMessage());
            return redirect()->back()->with('error', $throwable->getMessage());
        }
    }


    /**
     * @desc : delete user
     * @param $user_id
     * @return RedirectResponse
     */
    public function deleteUser($user_id): RedirectResponse
    {
        try{
            $user = User::where('id',$user_id)->first();

            if($user){
                $user->update(['status' => 'deleted']);
                return redirect()->back()->with('success', 'User deleted successfully');
            }
            return redirect()->back()->with('error', 'User not found');
        }
        catch (\Throwable $throwable){
            logger()->error($throwable->getMessage());
            return redirect()->back()->with('error', $throwable->getMessage());
        }
    }
}
