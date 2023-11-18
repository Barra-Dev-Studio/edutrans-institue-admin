<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\PaymentController;
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

Route::view('/', 'welcome')->name('home');
Route::view('/courses', 'courses')->name('courses');
Route::get('/course/{slug}',[GuestController::class, 'courseDetail'])->name('course.detail');
Route::get('/checkout/{slug}', [MemberController::class,'checkout'])->name('checkout');
Route::get('payment/{transactionId}', [PaymentController::class, 'index'])->name('payment.index');
Route::get('payment/qris/{transactionId}', [PaymentController::class, 'qris'])->name('payment.qris');

Route::middleware(['auth', 'can:access-admin'])->group(function () {
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

Route::middleware(['auth','can:access-member'])->group(function () {
    Route::prefix('member')->as('member.')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('index');
        Route::get('/transaction', [MemberController::class,'transaction'])->name('transaction');
        Route::get('/transaction/{id}', [MemberController::class,'detailTransaction'])->name('transaction.show');
        Route::get('/play/{slug}', [MemberController::class,'play'])->name('play');
    });
});

require __DIR__.'/auth.php';
