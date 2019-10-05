<?php

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

Auth::routes();
Route::get('/', 'HomeController@welcome')  ;
Route::get('/home', 'HomeController@index')    
    ->name('home');
Route::get('/backend', 'HomeController@bologin');
Route::get('/googledoc', 'GoogleController@googledoc');

// Static URLs
Route::view('/faq', 'faq');
Route::view('/contact', 'contact');
Route::view('/about', 'about');
Route::view('/privacy', 'privacy');
Route::view('/terms', 'terms');
