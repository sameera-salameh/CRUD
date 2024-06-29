<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use League\MimeTypeDetection\FinfoMimeTypeDetector;

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
// Route::get('/', function () {
//     return view('auth.login');
// });
//     Route::group(['middleware'=>['role:admin']], function(){
//         Route::resource('categories', CategoryController::class);
//         Route::resource('tags', TagController::class);
//         Route::get('/dashboard',[AdminController::class , 'index'])->name('dashboard.index');
//         Route::post('/users/create',[AdminController::class , 'createUser'])->name('dashboard.createUser');
//         Route::put('/users/{id}/block',[AdminController::class , 'blockUser'])->name('dashboard.block');
//         Route::put('/users/{id}/unblock',[AdminController::class , 'unblockUser'])->name('dashboard.unblock');
//     });  
//     Route::get('logout' , [AuthController::class , 'logout'])->name('logout');

// Route::middleware(['guest'])->group(function(){
//     Route::post('login', [AuthController::class, 'login']);
//     Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// });
Route::get('/home', function () {
    return view('auth.login');
});


Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
    Route::post('/users/create', [AdminController::class, 'createUser'])->name('dashboard.createUser');
    Route::put('/users/{id}/block', [AdminController::class, 'blockUser'])->name('dashboard.block');
    Route::put('/users/{id}/unblock', [AdminController::class, 'unblockUser'])->name('dashboard.unblock');
});

Route::middleware(['guest'])->group(function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');



