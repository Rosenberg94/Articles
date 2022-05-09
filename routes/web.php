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
        Route::get('/edit/form/{id}', '\App\Http\Controllers\ArticleController@articleEditForm')->middleware('article.belongs.user')->name('article_edit');
        Route::post('/update', '\App\Http\Controllers\ArticleController@articleUpdate')->middleware('article.belongs.user')->name('article_update');
        Route::post('/delete', '\App\Http\Controllers\ArticleController@destroy')->middleware('article.belongs.user')->name('article_delete');
    });

    Route::group(['prefix'=> 'category'], function () {
        Route::get('/', '\App\Http\Controllers\CategoryController@allCategories')->name('categories');
        Route::get('/create/form', '\App\Http\Controllers\CategoryController@categoryCreateForm')->middleware('check.user.role')->name('category_create_form');
        Route::post('/create', '\App\Http\Controllers\CategoryController@categoryCreate')->middleware('check.user.role')->name('category_create');
        Route::get('/edit/{id}', '\App\Http\Controllers\CategoryController@categoryEdit')->middleware('check.user.role')->name('category_edit');
        Route::post('/update', '\App\Http\Controllers\CategoryController@categoryUpdate')->middleware('check.user.role')->name('category_update');
        Route::post('/delete', '\App\Http\Controllers\CategoryController@destroy')->middleware('check.user.role')->name('category_delete');
    });

    Route::group(['prefix'=> 'comment'], function () {
        Route::get('/create/form', '\App\Http\Controllers\CommentController@createForm')->name('comment_create_form');
        Route::post('/create', '\App\Http\Controllers\CommentController@create')->name('comment_create');
        Route::get('/edit', '\App\Http\Controllers\CommentController@edit')->middleware('comment.belongs.user')->name('comment_edit');
        Route::post('/update', '\App\Http\Controllers\CommentController@update')->middleware('comment.belongs.user')->name('comment_update');
        Route::post('/delete', '\App\Http\Controllers\CommentController@destroy')->middleware('comment.belongs.user')->name('comment_delete');
    });

    Route::group(['prefix'=> 'like'], function () {
        Route::get('/add', '\App\Http\Controllers\ArticleController@like')->name('like');
    });
});






