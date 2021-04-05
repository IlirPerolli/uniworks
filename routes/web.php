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
})->name('index');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'admin'])->group(function(){
Route::get('admin/category/create','App\Http\Controllers\CategoriesController@create' )->name('category.create');
    Route::post('admin/category/store', 'App\Http\Controllers\CategoriesController@store')->name('category.store');
    Route::delete('admin/category/{category}/destroy','App\Http\Controllers\CategoriesController@destroy')->name('category.destroy');
    Route::get('admin/users','App\Http\Controllers\AdminController@users')->name('admin.users.show');
    Route::delete('admin/user/{user}/destroy','App\Http\Controllers\AdminController@destroy')->name('admin.users.destroy');

});

Route::get('autocomplete', 'App\Http\Controllers\PostsController@autocomplete')->name('autocomplete');
Route::get('/user/university/autocomplete', 'App\Http\Controllers\UserProfileController@autocomplete')->name('user.university.autocomplete');
Route::get('/user/city/autocomplete', 'App\Http\Controllers\UserProfileController@autocomplete_city')->name('user.city.autocomplete');
Route::middleware('auth',)->group(function(){
    Route::get('/post/create', 'App\Http\Controllers\PostsController@create')->name('post.create');
    Route::post('/post/store', 'App\Http\Controllers\PostsController@store')->name('post.store');
    Route::get('/user/changePassword', 'App\Http\Controllers\UserChangePasswordController@index')->name('user.password.edit');
    Route::patch('/user/changePassword/update', 'App\Http\Controllers\UserChangePasswordController@update')->name('user.password.update');
    Route::get('/user/edit','App\Http\Controllers\UserProfileController@edit')->name('user.edit');
    Route::patch('/user/update','App\Http\Controllers\UserProfileController@update')->name('user.update');
    Route::get('/user/changeUsername', 'App\Http\Controllers\UserChangeUsernameController@index')->name('user.username.edit');
    Route::patch('/user/changeUsername/update', 'App\Http\Controllers\UserChangeUsernameController@update')->name('user.username.update');
    Route::get('/user/changePhoto', 'App\Http\Controllers\UserChangePhotoController@index')->name('user.photo.edit');
    Route::patch('/user/changePhoto/update', 'App\Http\Controllers\UserChangePhotoController@update')->name('user.photo.update');
    Route::patch('/user/changePhoto/destroy', 'App\Http\Controllers\UserChangePhotoController@destroy')->name('user.photo.destroy');

    Route::get('/user/deleteAccount', 'App\Http\Controllers\UserDeleteAccountController@index')->name('user.delete.page');
    Route::delete('/user/destroy', 'App\Http\Controllers\UserDeleteAccountController@destroy')->name('user.destroy');
});

Route::get('/category/{category}','App\Http\Controllers\CategoriesController@show')->name('category.show');
Route::get('/search/users','App\Http\Controllers\SearchController@users')->name('search.users');
Route::get('/search/posts','App\Http\Controllers\SearchController@posts')->name('search.posts');
Route::get('/{user}','App\Http\Controllers\UserProfileController@show')->name('user.show');

