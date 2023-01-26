<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

/**
 * Posts
 */
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function () {
    Route::get('/create', [PostController::class, 'createForm'])->name('create');
    Route::post('/create', [PostController::class, 'create'])->name('create.send');

    Route::get('/posts/{post}/delete', [PostController::class, 'delete'])->name('delete');
    Route::get('/posts/{post}/edit', [PostController::class, 'editForm'])->name('edit');
    Route::post('/posts/{post}/edit', [PostController::class, 'edit'])->name('edit.send');

    /**
     * Profile
     */
    Route::get('/profile', [ProfileController::class, 'editForm'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('profile.edit.send');
});



/**
 * Auth
 */
Route::get('/registration', [AuthController::class, 'registrationForm'])->name('registration');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration.send');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.send');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

