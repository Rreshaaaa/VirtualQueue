<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// Student registration and login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('student.register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/login', [AuthController::class, 'login']);

// Admin login
Route::get('/admin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);


/*
|--------------------------------------------------------------------------
| Student Routes (Protected by 'auth:student')
|--------------------------------------------------------------------------
*/
Route::middleware('auth:student')->group(function () {
    Route::get('/queue', [QueueController::class, 'queuePage'])->name('student.queue');
    Route::match(['get', 'post'], '/queue/join', [QueueController::class, 'joinQueue'])->name('queue.join');
    Route::post('/queue/cancel', [QueueController::class, 'cancelQueue'])->name('queue.cancel');

});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by 'auth:admin')
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [QueueController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/queue/call-next', [QueueController::class, 'callNext'])->name('queue.callNext');
    Route::post('/queue/done', [QueueController::class, 'markDone'])->name('queue.markDone');
});

// Student routes
Route::middleware('auth:student')->group(function () {
    Route::post('/student/logout', [LogoutController::class, 'logoutStudent'])->name('student.logout');
});

// Admin routes
Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/logout', [LogoutController::class, 'logoutAdmin'])->name('admin.logout');
});

Route::middleware(['auth:student'])->group(function () {
    Route::get('/student/profile/show', [StudentController::class, 'show'])->name('student.profile.show');
    Route::get('/student/profile/edit', [StudentController::class, 'edit'])->name('student.profile.edit');
    Route::put('/student/profile', [StudentController::class, 'update'])->name('student.profile.update');
});
