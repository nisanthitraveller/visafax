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

//Auth::routes();
//Route::any('login/', 'HomeController@welcome');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/landing', 'HomeController@welcome')->name('login');
Route::get('/', 'HomeController@landing');
Route::any('/logout', 'HomeController@logout')->name('logout');
Route::get('/home', 'HomeController@index')    
    ->name('home');
Route::get('/backend', 'HomeController@bologin');
Route::get('/googledoc', 'GoogleController@googledoc');

Route::get('/autocomplete', 'HomeController@autocomplete')->name('autocomplete');

Route::any('/visa/{visaUrl}', 'HomeController@visaold');
Route::any('/visa-application/{visaUrl}', 'HomeController@visa');
Route::any('/visa1/{visaUrl}', 'HomeController@visa');
Route::any('/applyvisa/payment/{bookingId}', 'VisaController@payment');
Route::any('/applyvisa/step1/{bookingId}', 'VisaController@step1');
Route::any('/applyvisa/step2/{bookingId}', 'VisaController@step2');
Route::any('/applyvisa/step3/{bookingId}', 'VisaController@step3');
Route::any('/createvisa', 'GoogleController@createvisa');
Route::any('/testvisa', 'VisaController@testvisa');
Route::any('/payusubmit', 'VisaController@payusubmit');
Route::any('/dashboard', 'VisaController@dashboard')->name('my-visas');
Route::any('/visadetails/{visaUrl}', 'VisaController@countrydashboard');
Route::any('/visa-details/{visaUrl}', 'VisaController@startvisa');
Route::any('/dashboard1', 'VisaController@dashboard')->name('my-visas1');
Route::any('/showform', 'VisaController@showform')->name('show-form');
Route::any('/userlocation', 'VisaController@userlocation')->name('userlocation');

// Static URLs
Route::view('/faq', 'faq');
Route::view('/contact', 'contact');
Route::view('/about', 'about');
Route::view('/privacy', 'privacy');
Route::view('/terms', 'terms');

Route::post('/userdata', 'HomeController@userdata')->name('userdata');
Route::any('/tokensignin', 'GoogleController@tokensignin')->name('tokensignin');
Route::get('/updatemobile', 'GoogleController@updatemobile')->name('updatemobile');

// AWS URLs
Route::any('/bucket', 'AwsController@bucket');
Route::post('/deleteimage/{image}', 'AwsController@destroy')->name('deleteimage');
Route::get('/s3/images', 'AwsController@image');
Route::post('/s3/store', 'AwsController@store');
Route::get('/readdoc', 'AwsController@readdoc');
