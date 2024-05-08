<?php

use App\Http\Controllers\FirebaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth:admin', 'Language', 'throttle:login'])->namespace('App\Http\Controllers\Admin')->prefix('admin')->group(function () {

    ///////////////////////////// Basic Routes /////////
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/search', 'HomeController@search')->name('search');
    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/update/{id}', 'ProfileController@update')->name('profile.update');
    Route::get('/language/{locale}', 'LanguageController@changeLanguage')->name('change.language');

    /////////////////// Users Routes ////////////////////////////
    Route::resource('/users', 'UserController')->missing(function (Request $request) {
        return redirect()->route('users.index');
    });

    ////////// Bookings Routes /////////////////////
    Route::get('/bookings', 'BookingController@index')->name('bookings.index');
    Route::get('/bookings/show/{id}', 'BookingController@show')->name('bookings.show');
    Route::put('/bookings/accept/{id}', 'BookingController@accept')->name('bookings.accept');
    Route::put('/bookings/reject/{id}', 'BookingController@reject')->name('bookings.reject');

    //////////////// City Routes/////////////////////////////
    Route::resource('/cities', 'CityController')->scoped(['city' => 'name']);

    ////////////////////// Setting Routes///////////////////

    Route::resource('/settings', 'SettingController');

    /////////////////////// rooms Routes ///////////////
    Route::get('/rooms', 'RoomController@index')->name('rooms.index');
    Route::get('/rooms/edit/{id}', 'RoomController@edit')->name('rooms.edit');
    Route::get('/rooms/show/{id}', 'RoomController@show')->name('rooms.show');
    Route::put('/rooms/update/{id}', 'RoomController@update')->name('rooms.update');
    Route::delete('/rooms/destroy/{id}', 'RoomController@destroy')->name('rooms.destroy');
    Route::get('/rooms/trashed', 'RoomController@trashed')->name('rooms.trash');
    Route::put('/rooms/restore/{id}', 'RoomController@restore')->name('rooms.restore');
    Route::delete('/rooms/delete/{id}', 'RoomController@delete')->name('rooms.delete');

    //////////////////////////// hotels Routes ///////////////
    Route::get('/hotels', 'HotelController@index')->name('hotels.index');
    Route::get('/hotels/create', 'HotelController@create')->name('hotels.create');
    Route::post('/hotels/store', 'HotelController@store')->name('hotels.store');
    Route::get('/hotels/edit/{id}', 'HotelController@edit')->name('hotels.edit');
    Route::get('/hotels/show/{id}', 'HotelController@show')->name('hotels.show');
    Route::put('/hotels/update/{id}', 'HotelController@update')->name('hotels.update');
    Route::delete('/hotels/destroy/{id}', 'HotelController@destroy')->name('hotels.destroy');
    Route::get('/hotels/trashed', 'HotelController@trashed')->name('hotels.trash');
    Route::put('/hotels/restore/{id}', 'HotelController@restore')->name('hotels.restore');
    Route::delete('/hotels/delete/{id}', 'HotelController@delete')->name('hotels.delete');

    ////////////////// reviews Routes /////////////////
    Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
    Route::delete('/reviews/destroy/{id}', 'ReviewController@destroy')->name('reviews.destroy');
});





Auth::routes();
