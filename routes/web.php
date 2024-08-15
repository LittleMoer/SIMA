<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CrewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapGajiCrewController;

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
//detail pesanan
Route::get('/detail_pesanan/{id}', [OrderController::class, 'detail','index'])->name('detail_pesanan');
Route::post('/detail_pesanan/{id}', [OrderController::class, 'updateSP'])->name('detail_pesanan');
//view data SP
Route::get('/view/{id}', [OrderController::class, 'view'])->name('view');
//view data SJ
Route::get('/viewSJ/{id}', [OrderController::class, 'viewSJ'])->name('viewSJ');
Route::delete('/pesanan/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

//Rekap Gaji
Route::get('/rekap-gaji-crew', [RekapGajiCrewController::class, 'index'])->name('rekap.gaji.index');
Route::post('/rekap-gaji-crew', [RekapGajiCrewController::class, 'show'])->name('rekap.gaji.show');
Route::post('/rekap-gaji-crew/generate', [RekapGajiCrewController::class, 'generatePayrollSummary'])->name('rekap.gaji.generate');
// // FE Rekap Gaji
// Route::get('/rekap_gaji_crew', function () {
//     return view('rekap_gaji_crew');
// });

Route::post('/manajemen_akun',  [AuthController::class, 'register'])->name('manajemen_akun');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('tambah_akun');
Route::get('/manajemen_akun', [UserController::class, 'index'])->name('manajemen_akun');
Route::post('/manajemen_akun/{username}', [UserController::class, 'update'])->name('user.update');
Route::delete('/manajemen_akun/{username}', [UserController::class, 'destroy'])->name('users.destroy');
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
   
});