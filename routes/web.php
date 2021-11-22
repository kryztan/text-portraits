<?php

use App\Http\Controllers\TextPortraitsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('text-portraits', [TextPortraitsController::class, 'index'])->name('text-portraits.index');
Route::post('text-portraits', [TextPortraitsController::class, 'store'])->name('text-portraits.store');

Route::get('portraits/louen', function () {
    return view('portraits.louen');
});
Route::get('portraits/louen-bnw', function () {
    return view('portraits.louen-bnw');
});
