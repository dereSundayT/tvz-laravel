<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\HomePage\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPanel\UserPanelController;
use App\Http\Middleware\IsAdminGuest;
use App\Http\Middleware\IsAdminMiddleware;

use Illuminate\Support\Facades\Route;




require __DIR__.'/auth.php';


//Admin
Route::group(['prefix' => 'admin'], static function () {
    //Auth Routes
    Route::middleware(IsAdminGuest::class)
        ->group(function () {
            Route::get('/', [AdminAuthController::class, 'loginView'])->name('admin.login');
            Route::post('', [AdminAuthController::class, 'login']);
        });
    //Dashboard Routes
    Route::middleware(IsAdminMiddleware::class)->group(function () {
        Route::post('logout', [AdminAuthController::class, 'adminLogout'])->name('admin.logout');
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        //Get all Users
        Route::prefix('users')->group(function (){
            Route::get('', [AdminUserController::class, 'getUsers'])->name('admin.users');
            Route::post('', [AdminUserController::class, 'addUser'])->name('admin.users.add');
            Route::put('{user_id}', [AdminUserController::class, 'updateUser'])->name('admin.users.update');
            Route::delete('{user_id}', [AdminUserController::class, 'deleteUser'])->name('admin.users.delete');
        });
    });
});

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('{username}', [HomeController::class, 'profilePage'])->name('home.profile');


//User Panel Routes
Route::middleware('auth')->group(function (){
    Route::post('/follow/{id}', [HomeController::class, 'follow'])->name('users.follow');
    Route::post('/unfollow/{id}', [HomeController::class, 'unfollow'])->name('users.unfollow');

    Route::prefix('panel')->group(function (){
        Route::get('home',[UserPanelController::class, 'getFollowers'])->name('panel.home');

        Route::get('home/followers',[UserPanelController::class, 'getFollowers'])->name('panel.followers');
        Route::get('home/following',[UserPanelController::class, 'getUserFollowing'])->name('panel.following');


        Route::group(['prefix' => 'profile'], static function () {
            Route::get('',[UserPanelController::class, 'profile'])->name('panel.profile');
            Route::post('change-password',[UserPanelController::class, 'changePassword'])->name('panel.change-password');
            Route::post('update-profile',[UserPanelController::class, 'updateProfile'])->name('panel.update-profile');
            Route::post('change-profile-mode',[UserPanelController::class, 'changeProfileMode'])->name('panel.change-profile-mode');
        });
    });


});




