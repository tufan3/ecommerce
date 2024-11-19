<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Auth::routes();

Route::get('/login', function(){
    return redirect()->to('/');
})->name('login');

Route::get('/register-user', function(){
    // return redirect()->to('/');
    return view('frontend.register_user');
})->name('register.user');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('user.logout');


/// frontend all route here---------------//
Route::group(['namespace'=>'App\Http\Controllers\Frontend'], function (){
    Route::get('/','FrontendController@index');
    Route::get('/product-details/{slug}','FrontendController@productDetails')->name('product.details');


    //__reviews route-----//
    Route::post('/store/review','ReviewController@store')->name('review.store');

});
