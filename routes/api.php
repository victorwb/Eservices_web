<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//hostels
Route::get('/hostels/images/{filename}', 'App\Http\Controllers\HostelApiController@show');
Route::get('/hostels', 'App\Http\Controllers\HostelApiController@index');
Route::post('/hostels', 'App\Http\Controllers\HostelApiController@store');
Route::put('/hostels/{id}', 'App\Http\Controllers\HostelApiController@update');
Route::delete('/hostels/{id}', 'App\Http\Controllers\HostelApiController@destroy');


//Shops
Route::get('/shops/images/{filename}', 'App\Http\Controllers\ShopApiController@show');
Route::get('/shops', 'App\Http\Controllers\ShopApiController@index');
Route::post('/shops', 'App\Http\Controllers\ShopApiController@store');
Route::put('/shops/{id}', 'App\Http\Controllers\ShopApiController@update');
Route::delete('/shops/{id}', 'App\Http\Controllers\ShopApiController@destroy');


//Hotels
Route::get('/hotels/images/{filename}', 'App\Http\Controllers\HotelApiController@show');
Route::get('/hotels', 'App\Http\Controllers\HotelApiController@index');
Route::post('/hotels', 'App\Http\Controllers\HotelApiController@store');
Route::put('/hotels/{id}', 'App\Http\Controllers\HotelApiController@update');
Route::delete('/hotels/{id}', 'App\Http\Controllers\HotelApiController@destroy');


//Healthcares
Route::get('/healthcares/images/{filename}', 'App\Http\Controllers\HealthCenterApiController@show');
Route::get('/healthcares', 'App\Http\Controllers\HealthCenterApiController@index');
Route::post('/healthcares', 'App\Http\Controllers\HealthCenterApiController@store');
Route::put('/healthcares/{id}', 'App\Http\Controllers\HealthCenterApiController@update');
Route::delete('/healthcares/{id}', 'App\Http\Controllers\HealthCenterApiController@destroy');


//Labours
Route::get('/labours/images/{filename}', 'App\Http\Controllers\LabourApiController@show');
Route::get('/labours', 'App\Http\Controllers\LabourApiController@index');
Route::post('/labours', 'App\Http\Controllers\LabourApiController@store');
Route::put('/labours/{id}', 'App\Http\Controllers\LabourApiController@update');
Route::delete('/labours/{id}', 'App\Http\Controllers\LabourApiController@destroy');

//Items
Route::get('/items/images/{filename}', 'App\Http\Controllers\ItemApiController@show');
Route::get('/items', 'App\Http\Controllers\ItemApiController@index'); 
Route::post('/items/selected', 'App\Http\Controllers\ItemApiController@itemParent');
Route::post('/items', 'App\Http\Controllers\ItemApiController@store');
Route::put('/items/{id}', 'App\Http\Controllers\ItemApiController@update');
Route::delete('/items/{id}', 'App\Http\Controllers\ItemApiController@destroy');

//users
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/photo/{id}', 'App\Http\Controllers\AuthController@uploadPhoto');
// Route::post('/users', 'App\Http\Controllers\AuthController@store');
// Route::put('/users/{id}', 'App\Http\Controllers\AuthController@update');
// Route::delete('/users/{id}', 'App\Http\Controllers\AuthController@destroy');

//chats
Route::post('/chat', 'App\Http\Controllers\ChatApiController@send');
Route::get('/chats', 'App\Http\Controllers\ChatApiController@index');
Route::post('/photo/{id}', 'App\Http\Controllers\ChatApiController@uploadPhoto');
// Route::post('/users', 'App\Http\Controllers\AuthController@store');
// Route::put('/users/{id}', 'App\Http\Controllers\AuthController@update');
// Route::delete('/users/{id}', 'App\Http\Controllers\AuthController@destroy');

//messaging
Route::post('/message', 'App\Http\Controllers\MessagingApiController@send');
Route::post('/messages', 'App\Http\Controllers\MessagingApiController@index');
Route::post('/photo/{id}', 'App\Http\Controllers\MessagingApiController@uploadPhoto');

//LectureRooms
Route::get('/lectureRooms/images/{filename}', 'App\Http\Controllers\LectureRoomApiController@show');
Route::get('/lectureRooms', 'App\Http\Controllers\LectureRoomApiController@index');
Route::post('/lectureRooms', 'App\Http\Controllers\LectureRoomApiController@store');
Route::put('/lectureRooms/{id}', 'App\Http\Controllers\LectureRoomApiController@update');
Route::delete('/lectureRooms/{id}', 'App\Http\Controllers\LectureRoomApiController@destroy');

Route::get('/restaurants', 'App\Http\Controllers\RestaurantApiController@index');
Route::post('/restaurants', 'App\Http\Controllers\RestaurantApiController@store');
Route::put('/restaurants/{id}', 'App\Http\Controllers\RestaurantApiController@update');
Route::delete('/restaurants/{id}', 'App\Http\Controllers\RestaurantApiController@destroy');
