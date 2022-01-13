<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'namespace'  => 'Wgnsy\Currency\app\Http\Controllers\Auth',
    'middleware' =>  'web'
], function () {
    Route::get('home', 'CurrencyAuthController@home')->name('home'); 
Route::get('login', 'CurrencyAuthController@index')->name('login');
Route::post('custom-login',  'CurrencyAuthController@login')->name('login.custom'); 
Route::get('registration',  'CurrencyAuthController@registration')->name('register-user');
Route::post('custom-registration',  'CurrencyAuthController@customRegistration')->name('register.custom'); 
Route::get('signout',  'CurrencyAuthController@signOut')->name('signout');
});
