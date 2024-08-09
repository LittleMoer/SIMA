<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CrewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/token', function (Request $request) {
    $token = csrf_token();
    return response()->json(['token' => $token]);
});


//auth
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('tambah_akun');

Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('user/dashboard', [CrewController::class, 'index'])->name('user.dashboard');
});


//order sp
Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
Route::post('/store', [OrderController::class, 'store'])->name('order.store');
Route::delete('/pesanan', [OrderController::class, 'destroy'])->name('order.destroy');

Route::post('/manajemen_akun',  [AuthController::class, 'register'])->name('manajemen_akun');
Route::middleware(['auth'])->group(function () {
    Route::get('/manajemen_akun', [UserController::class, 'index'])->name('manajemen_akun');
    Route::post('/manajemen_akun/{username}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/manajemen_akun/{username}', [UserController::class, 'destroy'])->name('users.destroy');
});