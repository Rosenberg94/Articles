<?php

use App\Http\Controllers\MainController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('/foo', [MainController::class, 'foo'])->name('foo');

Route::group(['middleware' =>'auth'], function() {
    Route::group(['prefix' => 'profile'], function() {
        Route::get('/edit', '\App\Http\Controllers\MainController@profileEdit')->name('profile_edit');
        Route::post('/update', '\App\Http\Controllers\MainController@profileUpdate')->name('profile_update');
    });

    Route::group(['prefix'=> 'article'], function () {
        Route::get('/{id}', '\App\Http\Controllers\ArticleController@articleShow')->name('article_show');
        Route::get('/create/form', '\App\Http\Controllers\ArticleController@articleCreateForm')->name('article_create_form');
        Route::post('/create', '\App\Http\Controllers\ArticleController@articleCreate')->name('article_create');
        Route::get('/edit/form/{id}', '\App\Http\Controllers\ArticleController@articleEditForm')->name('article_edit');
        Route::post('/update', '\App\Http\Controllers\ArticleController@articleUpdate')->name('article_update');
        Route::post('/delete', '\App\Http\Controllers\ArticleController@destroy')->name('article_delete');
    });

    Route::group(['prefix'=> 'category'], function () {
        Route::get('/', '\App\Http\Controllers\CategoryController@allCategories')->name('categories');
        Route::get('/create/form', '\App\Http\Controllers\CategoryController@categoryCreateForm')->name('category_create_form');
        Route::post('/create', '\App\Http\Controllers\CategoryController@categoryCreate')->name('category_create');
        Route::get('/edit/{id}', '\App\Http\Controllers\CategoryController@categoryEdit')->name('category_edit');
        Route::post('/update', '\App\Http\Controllers\CategoryController@categoryUpdate')->name('category_update');
        Route::post('/delete', '\App\Http\Controllers\CategoryController@destroy')->name('category_delete');
    });
});






