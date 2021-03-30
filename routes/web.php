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

});

Route::get('autocomplete', 'App\Http\Controllers\PostsController@autocomplete')->name('autocomplete');
Route::middleware('auth',)->group(function(){
    Route::get('/post/create', 'App\Http\Controllers\PostsController@create')->name('post.create');
    Route::post('/post/store', 'App\Http\Controllers\PostsController@store')->name('post.store');
    Route::get('/user/changePassword', 'App\Http\Controllers\UserChangePasswordController@index')->name('user.password.edit');
    Route::patch('/user/changePassword/update', 'App\Http\Controllers\UserChangePasswordController@update')->name('user.password.update');
});

Route::get('/category/{category}','App\Http\Controllers\CategoriesController@show')->name('category.show');
Route::get('/search/users','App\Http\Controllers\SearchController@users')->name('search.users');
Route::get('/search/posts','App\Http\Controllers\SearchController@posts')->name('search.posts');
Route::get('/{user}','App\Http\Controllers\UserProfileController@show')->name('user.show');

