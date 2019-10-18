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

Route::get('/countries', 'Admin\CountryController@get')->name('admin.countries');
Route::any('/editcountry/{Id}', 'Admin\CountryController@editcountry')->name('admin.editcountry');
Route::any('/country/assigndocument/{Id}', 'Admin\CountryController@countrydocument')->name('admin.countrydocuments');
Route::any('/country/price/{Id}', 'Admin\CountryController@countryprice')->name('admin.countryprice');

Route::get('/bookings', 'Admin\BookingsController@get')->name('admin.bookings');
Route::any('/editbooking/{bookingId}', 'Admin\BookingsController@editbooking')->name('admin.editbooking');

Route::get('/documenttypes', 'Admin\DocumentsController@documenttypes')->name('admin.documenttypes');
Route::any('/editdocumenttype/{Id}', 'Admin\DocumentsController@editdocumenttype')->name('admin.editdocumenttype');
Route::any('/adddocumenttype', 'Admin\DocumentsController@adddocumenttype')->name('admin.adddocumenttype');

Route::get('/pricingtypes', 'Admin\PricingController@pricingtypes')->name('admin.pricingtypes');
Route::any('/editpricingtype/{Id}', 'Admin\PricingController@editpricingtype')->name('admin.editpricingtype');
Route::any('/addpricingtype', 'Admin\PricingController@addpricingtype')->name('admin.addpricingtype');
