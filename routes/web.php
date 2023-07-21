<?php

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

Route::get('/', function () {
    return view('login');
});



// Route::get('/index', function () {
//     return view('admin.dashboard');
// });

Route::get('/login','App\Http\Controllers\LoginController@authenticate');

// Route::resource('','App\Http\Controllers\LoginController');




Route::group(['middleware'=>'isAdmin'],
function(){
Route::resource('index','App\Http\Controllers\DashboardController');
Route::resource('user','App\Http\Controllers\UserController');
Route::resource('hostel','App\Http\Controllers\HostelController');

Route::resource('healthcare','App\Http\Controllers\HealthCareController');

Route::resource('restaurant','App\Http\Controllers\RestaurantController');

Route::resource('shop','App\Http\Controllers\ShopController');

Route::resource('lectureRoom','App\Http\Controllers\LectureRoomController');

Route::resource('labour','App\Http\Controllers\LabourController');

Route::resource('hotel','App\Http\Controllers\HotelController');
Route::resource('item','App\Http\Controllers\ItemController');
Route::get('/map', function () {
    return view('admin.geomap');
});
});

