<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CrewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapGajiCrewController;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\BbmController;
use App\Models\RekapGajiCrew;

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


//order
Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
Route::post('/store', [OrderController::class, 'store'])->name('order.store');
//detail pesanan
Route::get('/detail_pesanan/{id}', [OrderController::class, 'detail'])->name('detail_pesanan');

//view data pesanan
// Route::get('/view/{id}', [OrderController::class, 'view'])->name('view');

//update order
Route::post('/detail_pesanan/{id}/update-sp', [OrderController::class, 'updateSP'])->name('pesanan.updateSP');
Route::put('/detail_pesanan/{id}/update-sj', [OrderController::class, 'updateSJ'])->name('pesanan.updateSJ');
Route::put('/detail_pesanan/{id}/update-spj', [OrderController::class, 'updateSPJ'])->name('pesanan.updateSPJ');
Route::delete('/pesanan/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

//konsumbbm
Route::get('/bbm/{id_spj}', [BbmController::class, 'index'])->name('bbm.index');
Route::delete('/bbm/{id}', [BbmController::class, 'destroy'])->name('bbm.destroy');



Route::get('/manajemen_armada/{id_armada}/rekap_gaji', [RekapGajiCrewController::class, 'showRekapGaji'])->name('manajemen_armada.rekap_gaji');
Route::get('/rekap-gaji-crew', [RekapGajiCrewController::class, 'show'])->name('rekap.gaji.show');
Route::post('/rekap-gaji-crew/generate', [RekapGajiCrewController::class, 'generate'])->name('rekap.gaji.generate');
// Route::get('rekap-gaji-crew/edit/{no_rekap}/{nama}', [RekapGajiCrewController::class, 'edit'])->name('rekap.gaji.edit');
// Route::put('rekap-gaji-crew/update/{no_rekap}/{nama}', [RekapGajiCrewController::class, 'update'])->name('rekap.gaji.update');

//manajemen akun
Route::post('/manajemen_akun',  [AuthController::class, 'register'])->name('manajemen_akun');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('tambah_akun');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/manajemen_akun', [UserController::class, 'index'])->name('manajemen_akun');
Route::post('/manajemen_akun/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/manajemen_akun/{id}', [UserController::class, 'destroy'])->name('users.destroy');


//Manajemen Armada
Route::get('/manajemen_armada', [ArmadaController::class, 'index'])->name('manajemen_armada.index');
Route::get('/manajemen_armada/create', [ArmadaController::class, 'create'])->name('manajemen_armada.create');
Route::post('/manajemen_armada', [ArmadaController::class, 'store'])->name('manajemen_armada.store');
Route::get('/manajemen_armada/{id_armada}/edit', [ArmadaController::class, 'edit'])->name('manajemen_armada.edit');
Route::post('/manajemen_armada/{id_armada}', [ArmadaController::class, 'update'])->name('manajemen_armada.update');
Route::delete('/manajemen_armada/{id_armada}', [ArmadaController::class, 'destroy'])->name('manajemen_armada.destroy');

//unit kendaraan
Route::get('/unit', [UnitController::class, 'index'])->name('unit.index');
Route::post('/unit', [UnitController::class, 'store'])->name('unit.store');
Route::put('/unit/{id_unit}', [UnitController::class, 'update'])->name('unit.update');
Route::delete('/unit/{id_unit}', [UnitController::class, 'destroy'])->name('unit.destroy');




//Bus
Route::get('/bus/big_bus', function () {
    return view('/bus/big_bus');
});
Route::get('/bus/micro_bus', function () {
    return view('/bus/micro_bus');
});
Route::get('/bus/medium_bus', function () {
    return view('/bus/medium_bus');
});
Route::get('/bus/mediumSE_bus', function () {
    return view('/bus/mediumSE_bus');
});


//Api Fetch Events
Route::get('/tes', function () {
    return view('tes');
});
Route::get('/api/events', [HomepageController::class,'index']);
