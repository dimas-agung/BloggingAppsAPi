<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostLikesController;
use App\Http\Controllers\PostsController;
use App\Models\PostComment;
use App\Models\PostLike;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::get('unauthorized', 'unauthorized')->name('unauthorized');
});
Route::controller(PostsController::class)->group(function () {
    Route::get('/post', 'index')->name('post.index');
    Route::get('/post/{post}', 'show')->name('post.show');
    Route::post('/post/store', 'store')->name('post.store');
    Route::put('/post/update/{post}', 'update')->name('post.update');
    Route::delete('/post/destroy/{post}', 'destroy')->name('post.delete');
});
Route::controller(PostLikesController::class)->group(function () {
    Route::get('/post-like', 'index')->name('post-like.index');
    Route::post('/post-like/store', 'store')->name('post-like.store');
    Route::delete('/post-like/destroy/{postLike}', 'destroy')->name('post-like.delete');
});
Route::controller(PostCommentsController::class)->group(function () {
    Route::get('/post-comment', 'index')->name('post-comment.index');
    Route::post('/post-comment/store', 'store')->name('post-comment.store');
    Route::put('/post-comment/update/{postComment}', 'update')->name('post-comment.update');
    Route::delete('/post-comment/destroy/{postComment}', 'destroy')->name('post-comment.delete');
});