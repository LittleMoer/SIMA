<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    $token = csrf_token();

    return response()->json(['token' => $token]);
});

route::get('/login', [AuthController::class, 'halamanlogin'])->name('login.post');
route::post('/login', [AuthController::class, 'login']);
route::get('/register', [AuthController::class,'halamanregis'])->name('register');
route::post('/register', [AuthController::class, 'registrasi'])->name('register.post');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');
