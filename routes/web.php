<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MabacController;
use App\Http\Controllers\MatriksController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::resource('/alternatif', AlternatifController::class);
Route::resource('/kriteria', KriteriaController::class);
Route::resource('/sub', SubKriteriaController::class);
Route::resource('/matriks', MatriksController::class);
Route::get('/hasil', 'MabacController@index')->name('hasil.index');
Route::get('/pdf', 'MabacController@cetak_pdf')->name('hasil.cetak_pdf');

Route::get('/about', function () {
    return view('about');
})->name('about');

