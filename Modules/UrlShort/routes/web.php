<?php

use Illuminate\Support\Facades\Route;
use Modules\UrlShort\Http\Controllers\UrlShortController;

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

Route::group(['middleware' => 'auth', 'prefix' => 'urlshort'], function () {
    Route::view('/', 'urlshort::index')->name('urlshort.index');
    Route::get('/show/{id}', [UrlShortController::class, 'show'])->name('urlshort.show');
    // Route::resource('urlshort', UrlShortController::class)->names('urlshort');
});

Route::get('/p/{code}', [UrlShortController::class, 'redirect'])->name('urlshort.redirect');
