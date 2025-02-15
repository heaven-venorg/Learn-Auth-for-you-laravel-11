<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');


    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('dashboard', function () {
            return view('admin.home');
        })->name('dashboard');

        Route::get('dashboard/post', function () {
            return view('admin.post');
        })->name('dashboard.post');

        Route::get('dashboard/user', function () {
            return view('admin.user');
        })->name('dashboard.user');

        // To Post
        // To Create View
        Route::prefix('dashboard/post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index');
            Route::get('create', [PostController::class, 'create'])->name('post.create');
            Route::post('create', [PostController::class, 'store'])->name('post.store');
            Route::get('edit',  [PostController::class, 'edit'])->name('post.edit');
            Route::post('edit', [PostController::class, 'update'])->name('post.update');
        });
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('register', [AuthController::class, 'createRegistrasi'])->name('registrasi.tampil');
Route::post('register', [AuthController::class, 'storeRegistrasi'])->name('registrasi.store');

Route::get('login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('login', [AuthController::class, 'actionLogin'])->name('login.action');