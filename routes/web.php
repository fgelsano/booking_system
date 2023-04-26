<?php

use App\Http\Middleware\PrivateURLsMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::group(['middleware' => 'publicURL'], function(){
    Route::get('/', function () {
        return view('frontpage');
    });

    Route::post('/dashboard/bookings/', [App\Http\Controllers\BookingsController::class, 'store'])->name('bookings.store');
});

Route::group(['middleware' => 'privateURL'], function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/bookings', [App\Http\Controllers\BookingsController::class, 'index'])->name('bookings.index');
    // Route::resource('/dashboard/bookings', 'App\Http\Controllers\BookingsController');
    Route::resource('/dashboard/passengers', 'App\Http\Controllers\PassengersController');
    Route::resource('/dashboard/payments', 'App\Http\Controllers\PaymentsController');


    Route::resource('/dashboard/reports', 'App\Http\Controllers\ReportsController');
    Route::resource('/dashboard/users', 'App\Http\Controllers\VesselsController');
 

    // Settings Routes
    
    Route::resource('/dashboard/settings/rates', 'App\Http\Controllers\RatesController');
    Route::resource('/dashboard/settings/vessels', 'App\Http\Controllers\VesselsController');
    Route::resource('/dashboard/settings/ports', 'App\Http\Controllers\PortsController');
    Route::resource('/dashboard/settings/accomodations', 'App\Http\Controllers\AccomodationsController');
    Route::resource('/dashboard/settings/schedules', 'App\Http\Controllers\SchedulesController'); 

});
