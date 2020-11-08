<?php

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
    return view('welcome');
});

Route::get('/change_password', [App\Http\Controllers\ProfileController::class, 'change_password'])->name('change_password');
Route::post('/update_password', [App\Http\Controllers\ProfileController::class, 'update_password'])->name('update_password');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/play/{id}', [App\Http\Controllers\HomeController::class, 'play'])->name('play');
Route::get('/by_category/{id}', [App\Http\Controllers\HomeController::class, 'by_category'])->name('by_category');


Route::resource('profile','App\Http\Controllers\ProfileController');
#Route::get('/profile/change_password', [App\Http\Controllers\ProfileController::class, 'change_password'])->name('profile.change_password');
#Route::post('/profile/update_password', [App\Http\Controllers\ProfileController::class, 'update_password'])->name('profile.update_password');
