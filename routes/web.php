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
    $tags = \App\Models\Tag::take(14)->get();
   return view('index',compact('tags'));
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
    Route::get('/article/create', 'App\Http\Controllers\PostsController@create')->name('post.create');
    Route::post('/article/store', 'App\Http\Controllers\PostsController@store')->name('post.store');
    Route::get('/article/{post}/edit', 'App\Http\Controllers\PostsController@edit')->name('post.edit');
    Route::patch('/article/{post}/update', 'App\Http\Controllers\PostsController@update')->name('post.update');
    Route::delete('/article/{post}/destroy','App\Http\Controllers\PostsController@destroy')->name('post.destroy');
    Route::delete('/article/{post}/removeTag','App\Http\Controllers\PostsController@remove_tag')->name('post.remove.tag');
    Route::get('/user/changePassword', 'App\Http\Controllers\UserChangePasswordController@index')->name('user.password.edit');
    Route::patch('/user/changePassword/update', 'App\Http\Controllers\UserChangePasswordController@update')->name('user.password.update');
    Route::get('/user/edit','App\Http\Controllers\UserProfileController@edit')->name('user.edit');
    Route::patch('/user/update','App\Http\Controllers\UserProfileController@update')->name('user.update');
    Route::get('/user/changeUsername', 'App\Http\Controllers\UserChangeUsernameController@index')->name('user.username.edit');
    Route::patch('/user/changeUsername/update', 'App\Http\Controllers\UserChangeUsernameController@update')->name('user.username.update');
    Route::get('/user/changePhoto', 'App\Http\Controllers\UserChangePhotoController@index')->name('user.photo.edit');
    Route::patch('/user/changePhoto/update', 'App\Http\Controllers\UserChangePhotoController@update')->name('user.photo.update');
    Route::patch('/user/changePhoto/destroy', 'App\Http\Controllers\UserChangePhotoController@destroy')->name('user.photo.destroy');
    Route::get('/bookmarks','App\Http\Controllers\BookmarksController@index')->name('bookmarks.index');
    Route::post('/post/{post}/wishlist/add','App\Http\Controllers\BookmarksController@store')->name('bookmarks.store');
    Route::delete('/post/{post}/wishlist/destroy','App\Http\Controllers\BookmarksController@destroy')->name('bookmarks.destroy');
    Route::get('/user/deleteAccount', 'App\Http\Controllers\UserDeleteAccountController@index')->name('user.delete.page');
    Route::delete('/user/destroy', 'App\Http\Controllers\UserDeleteAccountController@destroy')->name('user.destroy');
});

Route::get('/category/{category}','App\Http\Controllers\CategoriesController@show')->name('category.show');
Route::get('/tag/{tag}','App\Http\Controllers\TagsController@show')->name('tag.show');
Route::get('/search/users','App\Http\Controllers\SearchController@users')->name('search.users');
Route::get('/search/posts','App\Http\Controllers\SearchController@posts')->name('search.posts');
Route::get('/article/{post}','App\Http\Controllers\PostsController@show')->name('post.show');
Route::get('/university/{university}','App\Http\Controllers\UniversitiesController@show')->name('university.show');
Route::get('/{user}','App\Http\Controllers\UserProfileController@show')->name('user.show');

