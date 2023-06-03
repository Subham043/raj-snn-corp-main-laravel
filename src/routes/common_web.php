<?php

use App\Modules\Enquiries\Controllers\EnquiryCreateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'throttle:3,1'], function () {
    Route::post('/enquiry/create', [EnquiryCreateController::class, 'post', 'as' => 'enquiry_create.post'])->name('enquiry_create.post');
    Route::post('/otp/resend', [EnquiryCreateController::class, 'resendOtp', 'as' => 'enquiry.resendOtp'])->name('enquiry.resendOtp');
Route::post('/otp/{uuid}', [EnquiryCreateController::class, 'verifyOtp', 'as' => 'enquiry.verifyOtp'])->name('enquiry.verifyOtp');
});
