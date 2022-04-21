<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    // return 'hello wolrd';
    return view('welcome');
});



Route::group(['middleware' => 'auth'],function(){

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create/', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/update',[PostController::class,'update'])->name('posts.update');
    Route::get('/posts/view/{post}',[PostController::class,'view'])->name('posts.view');
    Route::delete('/posts/delete',[PostController::class,'delete'])->name('posts.delete');
    Route::get('/req_comment/{post}/{content}/{user_id}',[CommentController::class,'add_comment'])->name('comment.create');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
