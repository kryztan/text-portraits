<?php

use App\Http\Controllers\TextPortraitsController;
use App\Http\Controllers\WorkoutController;
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

Route::get('workout', [WorkoutController::class, 'index'])->name('workout.index');

Route::post('workoutprocess', [WorkoutController::class, 'workoutprocess'])->name('workout.workoutprocess');
