<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/my-profile', [UserController::class, 'index'])->name('my-profile');
    Route::view('/acoount-settings', 'user::account-settings')->name('account-settings');
    Route::view('/account-security', 'user::account-security')->name('account-security');
}
);


