<?php

use App\Modules\Authentication\Controllers\PasswordUpdateController;
use App\Modules\Authentication\Controllers\ForgotPasswordController;
use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Authentication\Controllers\ProfileController;
use App\Modules\Authentication\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'get', 'as' => 'login.get'])->name('login.get');
    Route::post('/authenticate', [LoginController::class, 'post', 'as' => 'login.post'])->name('login.post');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'get', 'as' => 'forgot_password.get'])->name('forgot_password.get');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'post', 'as' => 'forgot_password.post'])->name('forgot_password.post');
    Route::get('/reset-password/{user_id}', [ResetPasswordController::class, 'get', 'as' => 'reset_password.get'])->name('reset_password.get');
    Route::post('/reset-password/{user_id}', [ResetPasswordController::class, 'post', 'as' => 'reset_password.post'])->name('reset_password.post');
});

Route::prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'get', 'as' => 'profile.get'])->name('profile.get');
    Route::post('/update', [ProfileController::class, 'post', 'as' => 'profile.post'])->name('profile.post');
    Route::post('/profile-password-update', [PasswordUpdateController::class, 'post', 'as' => 'password.post'])->name('password.post');
});

Route::get('/logout', [LogoutController::class, 'get', 'as' => 'logout.get'])->name('logout.get');
