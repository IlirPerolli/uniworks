<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',function(){
   return view('index');
})->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/create', 'App\Http\Controllers\PostsController@create')->name('post.create');
Route::post('/post/store', 'App\Http\Controllers\PostsController@store')->name('post.store');

Route::get('autocomplete', 'App\Http\Controllers\PostsController@autocomplete')->name('autocomplete');

