<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('homepage');
});

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    $token = csrf_token();

    return response()->json(['token' => $token]);
});

Route::get('/create-order', [OrderController::class, 'create'])->name('order.create')->middleware('auth');
Route::post('/store-order', [OrderController::class, 'store'])->name('order.store')->middleware('auth');

Route::get('/data_sp', function () {
    return view('data_sp');
});

Route::get('/jadwal_owner', function () {
    return view('jadwal_owner');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/pesanan', function () {
    return view('pesanan');
});


