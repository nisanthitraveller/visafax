<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Auth::routes();

Route::get('/', 'AdminController@admin')->name('admin');
Route::get('/users', 'Admin\UserController@get')->name('admin.users');
Route::any('/edituser/{userId}', 'Admin\UserController@edituser')->name('admin.edituser');
Route::get('/bookings', 'Admin\BookingsController@get')->name('admin.bookings');
Route::any('/editbooking/{bookingId}', 'Admin\BookingsController@editbooking')->name('admin.editbooking');
Route::get('/login', 'HomeController@bologin');
#Route::get('/reviews/accepted/{id}','Admin\ReviewsController@accept')->where('id','\d+')->name('admin.accepted');
#Route::delete('/reviews/delete','Admin\ReviewsController@delete')->name('reviews.delete');