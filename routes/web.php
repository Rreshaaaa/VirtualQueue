<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\LogoutController;

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
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin and student dashboards
Route::middleware(['auth','student'])->group(function () {
    // Student Dashboard
    Route::get('/student/dashboard', [QueueController::class, 'studentDashboard'])->name('student.dashboard');
    Route::post('/queue/join', [QueueController::class, 'joinQueue'])->name('queue.join');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [QueueController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/queue/call-next', [QueueController::class, 'callNext'])->name('queue.callNext');
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::post('/queue/join', [QueueController::class, 'joinQueue'])->name('queue.join');
    Route::post('/queue/cancel', [QueueController::class, 'cancelQueue'])->name('queue.cancel');
});
Route::middleware('auth')->group(function () {
    Route::get('/student/dashboard', [QueueController::class, 'studentDashboard'])->name('student.dashboard');
    Route::get('/admin/dashboard', [QueueController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});


Route::get('/', function () {
    return view('welcome');
});
