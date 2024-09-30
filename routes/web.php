<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('home');
Route::prefix('user')->middleware(['auth'])->group(function () {

    
    //posts
    Route::get('addPost', [PostController::class,'create'])->name('addPost');
    Route::post('storePost',[PostController::class,'store'])->name('storePost');
    Route::get('listPost',[PostController::class,'index'])->name('listPost');
    Route::get('updatePost/{id}', [PostController::class,'edit']);
    Route::put('updateposts/{id}', [PostController::class,'update'])->name('updateposts');
    Route::get('deletePost/{id}', [PostController::class,'destroy']);

    //comments
    Route::get('allPost',[CommentController::class,'index'])->name('allPost');
    Route::get('addComment/{id}', [CommentController::class,'create']);
    Route::post('storeComment',[CommentController::class,'store'])->name('storeComment');
    Route::get('comment',[CommentController::class,'indexComment'])->name('comment');
    Route::get('updateComment/{id}', [CommentController::class,'edit']);
    Route::put('updateComm/{id}', [CommentController::class,'update'])->name('updateComm');
    Route::get('deleteComment/{id}', [CommentController::class,'destroy']);
    Route::get('showDetails/{id}', [CommentController::class,'show']);

});
