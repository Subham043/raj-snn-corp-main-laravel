<?php

use App\Modules\Authentication\Controllers\PasswordUpdateController;
use App\Modules\Authentication\Controllers\ForgotPasswordController;
use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Authentication\Controllers\ProfileController;
use App\Modules\Authentication\Controllers\ResetPasswordController;
use App\Modules\Projects\Controllers\ProjectAboutController;
use App\Modules\Projects\Controllers\ProjectAmenitiesCreateController;
use App\Modules\Projects\Controllers\ProjectAmenitiesDeleteController;
use App\Modules\Projects\Controllers\ProjectAmenitiesPaginateController;
use App\Modules\Projects\Controllers\ProjectAmenitiesUpdateController;
use App\Modules\Projects\Controllers\ProjectCreateController;
use App\Modules\Projects\Controllers\ProjectDeleteController;
use App\Modules\Projects\Controllers\ProjectLocationController;
use App\Modules\Projects\Controllers\ProjectPaginateController;
use App\Modules\Projects\Controllers\ProjectUpdateController;
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

Route::middleware(['auth'])->group(function () {

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'get', 'as' => 'profile.get'])->name('profile.get');
        Route::post('/update', [ProfileController::class, 'post', 'as' => 'profile.post'])->name('profile.post');
        Route::post('/profile-password-update', [PasswordUpdateController::class, 'post', 'as' => 'password.post'])->name('password.post');
    });

    Route::prefix('/project')->group(function () {
        Route::get('/create', [ProjectCreateController::class, 'get', 'as' => 'project_create.get'])->name('project_create.get');
        Route::post('/create-post', [ProjectCreateController::class, 'post', 'as' => 'project_create.post'])->name('project_create.post');
        Route::get('/list', [ProjectPaginateController::class, 'get', 'as' => 'project_list.get'])->name('project_list.get');
        Route::get('/delete/{id}', [ProjectDeleteController::class, 'get', 'as' => 'project_delete.get'])->name('project_delete.get');
        Route::get('/update/{id}', [ProjectUpdateController::class, 'get', 'as' => 'project_update.get'])->name('project_update.get');
        Route::post('/update-post/{id}', [ProjectUpdateController::class, 'post', 'as' => 'project_update.post'])->name('project_update.post');
        Route::get('/about/{project_id}', [ProjectAboutController::class, 'get', 'as' => 'project_about.get'])->name('project_about.get');
        Route::post('/about-post/{project_id}', [ProjectAboutController::class, 'post', 'as' => 'project_about.post'])->name('project_about.post');
        Route::get('/location/{project_id}', [ProjectLocationController::class, 'get', 'as' => 'project_location.get'])->name('project_location.get');
        Route::post('/location-post/{project_id}', [ProjectLocationController::class, 'post', 'as' => 'project_location.post'])->name('project_location.post');
        Route::prefix('/amenities/{project_id}')->group(function () {
            Route::get('/create', [ProjectAmenitiesCreateController::class, 'get', 'as' => 'project_amenities_create.get'])->name('project_amenities_create.get');
            Route::post('/create-post', [ProjectAmenitiesCreateController::class, 'post', 'as' => 'project_amenities_create.post'])->name('project_amenities_create.post');
            Route::get('/list', [ProjectAmenitiesPaginateController::class, 'get', 'as' => 'project_amenities_list.get'])->name('project_amenities_list.get');
            Route::get('/delete/{id}', [ProjectAmenitiesDeleteController::class, 'get', 'as' => 'project_amenities_delete.get'])->name('project_amenities_delete.get');
            Route::get('/update/{id}', [ProjectAmenitiesUpdateController::class, 'get', 'as' => 'project_amenities_update.get'])->name('project_amenities_update.get');
            Route::post('/update-post/{id}', [ProjectAmenitiesUpdateController::class, 'post', 'as' => 'project_amenities_update.post'])->name('project_amenities_update.post');

        });
    });

    Route::get('/logout', [LogoutController::class, 'get', 'as' => 'logout.get'])->name('logout.get');

});
