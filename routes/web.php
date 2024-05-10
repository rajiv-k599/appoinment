<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function()
{
    Route::get("/profile",[ProfileController::class, 'index'])->name("profile");
    Route::post("/profile/edit",[ProfileController::class, 'profileEdit'])->name("profileEdit");
});
Route::middleware(['auth','type:Patient'])->group(function()
{
    Route::get("/appointment/myHistory",[HomeController::class, 'history'])->name("userHistory");
    Route::get("/appointment/{id}",[HomeController::class, 'appointment'])->name("appointment");
    Route::post("/appointment/book",[HomeController::class, 'appoint'])->name("appoint");
    
});
Route::middleware(['auth','type:Doctor'])->group(function()
{
    Route::get("/doctor/myHistory",[HomeController::class, 'doctorHistory'])->name("doctorHistory");    
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
