<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->as('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('profile', [DashboardController::class, 'profile'])->name('profile');

        Route::resource('category', CategoryController::class);
        Route::resource('user', UserController::class);
        Route::resource('mentor', MentorController::class);
        Route::resource('course', CourseController::class);
        Route::resource('chapter', ChapterController::class);
    });
});

require __DIR__.'/auth.php';
