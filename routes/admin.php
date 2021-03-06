<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Auth::routes();

Route::get('/', 'AdminController@admin')->name('admin');
Route::get('/login', 'HomeController@bologin');

Route::get('/users', 'Admin\UserController@get')->name('admin.users');
Route::any('/edituser/{userId}', 'Admin\UserController@edituser')->name('admin.edituser');
Route::get('/enquiries', 'Admin\UserController@enquiries')->name('admin.enquiries');
Route::any('/editenquiry/{userId}', 'Admin\UserController@editenquiry')->name('admin.editenquiry');
Route::any('/deleteenquiry/{userId}', 'Admin\UserController@deleteenquiry')->name('admin.deleteenquiry');

Route::get('/countries', 'Admin\CountryController@get')->name('admin.countries');
Route::any('/editcountry/{Id}', 'Admin\CountryController@editcountry')->name('admin.editcountry');
Route::any('/country/assigndocument/{Id}', 'Admin\CountryController@countrydocument')->name('admin.countrydocuments');
Route::any('/country/price/{Id}', 'Admin\CountryController@countryprice')->name('admin.countryprice');

Route::get('/bookings', 'Admin\BookingsController@get')->name('admin.bookings');
Route::any('/editbooking/{bookingId}', 'Admin\BookingsController@editbooking')->name('admin.editbooking');
Route::get('/assigndoc/{bookingId}', 'Admin\BookingsController@assigndoc')->name('admin.assigndoc');
Route::any('/viewdocument/{bookingId}', 'Admin\BookingsController@viewdocument')->name('admin.viewdoc');
Route::post('/submitdoc', 'GoogleController@submitdoc')->name('admin.submitdoc');

Route::get('/hotels/{bookingId}', 'Admin\HotelsController@hotels')->name('admin.hotels');
Route::any('/edithotel/{bookingId}', 'Admin\HotelsController@edithotel')->name('admin.edithotel');
Route::any('/addhotel/{bookingId}', 'Admin\HotelsController@addhotel')->name('admin.addhotel');

Route::get('/documenttypes', 'Admin\DocumentsController@documenttypes')->name('admin.documenttypes');
Route::any('/editdocumenttype/{Id}', 'Admin\DocumentsController@editdocumenttype')->name('admin.editdocumenttype');
Route::any('/adddocumenttype', 'Admin\DocumentsController@adddocumenttype')->name('admin.adddocumenttype');

Route::get('/pricingtypes', 'Admin\PricingController@pricingtypes')->name('admin.pricingtypes');
Route::any('/editpricingtype/{Id}', 'Admin\PricingController@editpricingtype')->name('admin.editpricingtype');
Route::any('/addpricingtype', 'Admin\PricingController@addpricingtype')->name('admin.addpricingtype');
