<?php

use App\Modules\Projects\Controllers\Main\ProjectViewMainController;
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


Route::get('/project', [ProjectViewMainController::class, 'get', 'as' => 'project_view_main.get'])->name('project_view_main.get');
