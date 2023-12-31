<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizController;
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
Route::view('/about', 'about')->name('about');
Route::get('/course/{slug}',[GuestController::class, 'courseDetail'])->name('course.detail');
Route::get('/checkout/{slug}', [MemberController::class,'checkout'])->name('checkout');
Route::get('payment/{transactionId}', [PaymentController::class, 'index'])->name('payment.index');
Route::get('payment/qris/{transactionId}', [PaymentController::class, 'qris'])->name('payment.qris');
Route::get('payment/va/{transactionId}', [PaymentController::class, 'va'])->name('payment.va');

Route::get('/email/verify', [EmailVerifyController::class, 'index'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'request'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerifyController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/post/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [DashboardController::class, 'profile'])->name('dashboard.profile');

    Route::middleware(['can:access-admin'])->group(function () {
        Route::prefix('dashboard')->as('dashboard.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');

            Route::resource('category', CategoryController::class);
            Route::get('user/export', [UserController::class, 'export'])->name('user.export');
            Route::resource('user', UserController::class);
            Route::resource('mentor', MentorController::class);
            Route::resource('course', CourseController::class);
            Route::resource('chapter', ChapterController::class);
            Route::resource('transaction', TransactionController::class)->only('index', 'show');
            Route::resource('post', PostController::class);
            Route::resource('categorypost', CategoryPostController::class);

            Route::get('/section/{courseId}/create', [SectionController::class, 'create'])->name('section.create');
            Route::get('/section/{id}/show', [SectionController::class, 'show'])->name('section.show');
            Route::get('/section/{courseId}', [SectionController::class, 'index'])->name('section.index');
            Route::resource('section', SectionController::class)->only('edit', 'destroy');

            Route::get('/rating/{courseId}/create', [RatingController::class, 'create'])->name('rating.create');
            Route::get('/rating/{id}/show', [RatingController::class, 'show'])->name('rating.show');
            Route::get('/rating/{courseId}', [RatingController::class, 'index'])->name('rating.index');
            Route::resource('rating', RatingController::class)->only('edit', 'destroy');

            Route::get('/quiz/{courseId}/create', [QuizController::class, 'create'])->name('quiz.create');
            Route::get('/quiz/{courseId}', [QuizController::class, 'index'])->name('quiz.index');
            Route::resource('quiz', QuizController::class)->only('edit', 'destroy');

            Route::get('/paymentmethod', [PaymentMethodController::class, 'index'])->name('paymentmethod.index');
        });
    });

    Route::middleware(['can:access-member', 'verified'])->group(function () {
        Route::prefix('member')->as('member.')->group(function () {
            Route::get('/', [MemberController::class, 'index'])->name('index');
            Route::get('/transaction', [MemberController::class,'transaction'])->name('transaction');
            Route::get('/transaction/{id}', [MemberController::class,'detailTransaction'])->name('transaction.show');
            Route::get('/play/{id}/{chapterId?}', [MemberController::class,'play'])->name('play');
            Route::get('/certificate/', [CertificateController::class, 'index'])->name('certificate');
            Route::get('/certificate/my/{id}', [CertificateController::class, 'generateCertificate'])->name('certificate.my');
            Route::get('/certificate/download/{id}', [CertificateController::class, 'download'])->name('certificate.download');
        });
    });
});


require __DIR__.'/auth.php';
