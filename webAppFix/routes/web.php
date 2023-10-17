<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\offDaysConstroller;
use App\Http\Controllers\WhatsappMessagesController;
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

// login route
Route::get('/', [authController::class, 'index'])->name('login');
Route::post('/', [authController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// date route
Route::get('/home',[offDaysConstroller::class, 'index'])->name('dateList');
Route::get('/read',[offDaysConstroller::class, 'read'])->name('read');
Route::get('/create',[offDaysConstroller::class, 'create'])->name('create');
Route::post('/store',[offDaysConstroller::class, 'store'])->name('store');
Route::post('/show/{id}',[offDaysConstroller::class, 'show'])->name('show');
Route::post('/update/{id}',[offDaysConstroller::class, 'update'])->name('update');
Route::post('/delete/{id}',[offDaysConstroller::class, 'destroy'])->name('delete');
Route::post('/filterByYear', [offDaysConstroller::class, 'filterByYear'])->name('filter');
// messages route
Route::get('/messages', [WhatsappMessagesController::class, 'index'])->name('messagesList');
Route::get('/readMessages',[WhatsappMessagesController::class, 'read'])->name('readMesseges');
