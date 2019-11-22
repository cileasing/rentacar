<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    

});

Route::group(['prefix' => 'v1', 'as' => 'v1'], function() {
    Route::post('/login', 'UsersController@login');

    Route::middleware('auth:api')->group(function () {
        Route::get('driver/show', ['uses' => 'DriverController@show'])->middleware('driver');
        Route::get('driver/history/show', ['uses' => 'DriverController@ride_history'])->middleware('driver');
        
        Route::post('sendOtp', ['uses' => 'UsersController@sendOtp']);
        Route::post('verifyOtp', ['uses' => 'UsersController@verifyOtp']);
        Route::get('user', ['uses' => 'UsersController@show']);
        Route::get('user', ['uses' => 'UsersController@show']);
        Route::get('driver/myVehicle', ['uses' => 'DriverController@myVehicle'])->middleware('driver');

         // DirectBookings
         Route::group(['prefix' => 'direct_booking', 'as' => 'direct_booking'], function() {
            //Route::post('create', ['uses' => 'DirectBookingController@store']);
            Route::post('/direct/create', ['uses' => 'DirectBookingController@store']); 
            Route::get('show/{id}', ['uses' => 'DirectBookingController@show']);
            Route::post('update/{id}', ['uses' => 'DirectBookingController@update']);
            Route::get('delete/{id}', ['uses' => 'DirectBookingController@destroy']);

            Route::post('/direct/accept/{booking_id}', ['uses' => 'DirectBookingController@acceptBooking']); 
            Route::post('/direct/cancel/{booking_id}', ['uses' => 'DirectBookingController@cancelBooking']);

        });

        // Bookings
        Route::group(['prefix' => 'booking', 'as' => 'booking'], function() {
            Route::post('create', ['uses' => 'BookingController@store']);
            Route::get('show/{id}', ['uses' => 'BookingController@show']);
            Route::post('update/{id}', ['uses' => 'BookingController@update']);
            Route::get('delete/{id}', ['uses' => 'BookingController@destroy']);

        });

        Route::post('/feedback/create/{driver_id}', ['uses' => 'FeedBackController@store']); 
        Route::get('show/{id}', ['uses' => 'FeedBackController@store']);
    
    
    });
});