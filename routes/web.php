<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/token', function (Request $request) {
    $token = csrf_token();
    return response()->json(['token' => $token]);
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('/manajemen_akun', [UserController::class, 'index'])->name('manajemen_akun');
Route::post('/manajemen_akun',  [AuthController::class, 'register'])->name('manajemen_akun');
Route::put('/manajemen_akun/{username}', [UserController::class, 'update'])->name('users.update');
Route::delete('/manajemen_akun/{username}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/tambah_akun', function () {return view('tambah_akun');});
Route::post('/tambah_akun', [AuthController::class, 'register'])->name('tambah_akun');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


