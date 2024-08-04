<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
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
// Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});


//order sp
Route::get('/order', [OrderController::class, 'create'])-> name('order');

route::get('/pesanan', function(){
    return view('pesanan');
});

//manajemen akun
Route::get('/manajemen_akun', [UserController::class, 'index'])->name('manajemen_akun');
Route::post('/manajemen_akun',  [AuthController::class, 'register'])->name('manajemen_akun');
// Route::post('/manajemen_akun/{username}', [UserController::class, 'update'])->name('user.update');

// Route::put('/manajemen_akun/', [UserController::class, 'update'])->name('users.update');
// Route::delete('/manajemen_akun/', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/manajemen_akun/{username}', [UserController::class, 'update'])->name('users.update');
Route::delete('/manajemen_akun/{username}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/tambah_akun', function () {
    return view('tambah_akun');
});
Route::post('/tambah_akun', [AuthController::class, 'register'])->name('tambah_akun');

