<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
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

// Auth
Route::get('account/login', [AuthController::class, 'viewLoginPage'])->middleware('api.auth.success')->name('login');
Route::post('account/login', [AuthController::class, 'login']);

// Index
Route::get('home/index', IndexController::class)->middleware('api.auth.failed')->name('index');

Route::get('flush', function(Request $request) {
    $request->session()->flush();
    return "ok";
})->name('flush');