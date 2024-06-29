<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\TagController;
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
// Route::post('/register', [AuthController::class, 'makeUser']);


Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('posts' , [PostController::class , 'index'])->name('posts.index');
    Route::post('posts' , [PostController::class , 'store'])->name('posts.store');
    Route::post('posts/{post}' , [PostController::class , 'update'])->name('posts.update');
    Route::get('posts/{post}' , [PostController::class , 'show'])->name('posts.show');
    Route::delete('posts/{post}' , [PostController::class , 'destroy'])->name('posts.destroy');
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');
    Route::post('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/tags', [TagController::class, 'index'])->name('api.tags.index');
    Route::get('/categories', [CategoryController ::class, 'index'])->name('api.categories.index');

    Route::post('/logout', [AuthController::class, 'logout']);
});