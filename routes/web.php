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
use App\Http\Controllers\PengeluaranController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isCrew;
use App\Http\Controllers\ViewerController;
use App\Http\Middleware\isViewer;
use App\Http\Controllers\CalendarController;

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


Route::middleware([isAdmin::class])->group(function () {
    //register awal
    //manajemen akun
    Route::post('/manajemen_akun',  [AuthController::class, 'register'])->name('manajemen_akun');
    Route::get('/manajemen_akun', [UserController::class, 'index'])->name('manajemen_akun');
    Route::post('/manajemen_akun/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/manajemen_akun/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('tambah_akun');
    
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    //order
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
    Route::post('/store', [OrderController::class, 'store'])->name('order.store');
    Route::delete('/pesanan/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    //detail pesanan
    Route::get('/pesanan/detail_pesanan/{id}', [OrderController::class, 'detail'])->name('detail_pesanan');
    
    
    
    //view data pesanan
    Route::get('/view/{id}', [OrderController::class, 'view'])->name('view');
    Route::get('/viewSJ/{id}', [OrderController::class, 'viewSJ'])->name('viewSJ');
    Route::get('/viewSPJ/{id}', [OrderController::class, 'viewSPJ'])->name('viewSPJ');
    //update order
    Route::post('/pesanan/detail_pesanan/{id}', [OrderController::class, 'updateSP'])->name('detail_pesanan');
    Route::put('/pesanan/detail_pesanan/{id}/update-sj', [OrderController::class, 'updateSJ'])->name('pesanan.updateSJ');
    Route::put('/pesanan/detail_pesanan/{id}/update-spj', [OrderController::class, 'updateSPJ'])->name('pesanan.updateSPJ');
    Route::get('/get-driver-codriver/{id}',[OrderController::class, 'getDriverCoDriver']);
    Route::get('/search-driver', [OrderController::class, 'searchDriver'])->name('search.driver');
    
    //konsumbbm
    Route::get('/bbm/{id_spj}', [BbmController::class, 'index', 'detailPesanan'])->name('bbm.index');
    Route::post('/bbm/{id_spj}', [BbmController::class, 'create'])->name('bbm.create');
    Route::get('/bbm/{idkonsumbbm}/edit-data', [BbmController::class, 'getEditData'])->name('bbm.getEditData');
    Route::post('/bbm/{idkonsumbbm}/edit', [BbmController::class, 'edit'])->name('bbm.edit');
    Route::delete('/bbm/{id}', [BbmController::class, 'destroy'])->name('bbm.destroy');
    
    //RekapGajiCrew
    Route::get('/manajemen_armada/{id_armada}/rekap_gaji', [RekapGajiCrewController::class, 'showRekapGaji'])->name('manajemen_armada.rekap_gaji');
    Route::get('/rekap-gaji-crew', [RekapGajiCrewController::class, 'show'])->name('rekap.gaji.show');
    Route::post('/rekap-gaji-crew/generate', [RekapGajiCrewController::class, 'generate'])->name('rekap.gaji.generate');
    Route::get('/rekap-gaji/edit/{id_armada}', [RekapGajiCrewController::class, 'edit'])->name('rekap.gaji.edit');
    Route::post('/rekap-gaji/update', [RekapGajiCrewController::class, 'update'])->name('rekap.gaji.update'); // Change to POST without {id}
    Route::post('/rekap-gaji/intensif/{id_armada}', [RekapGajiCrewController::class, 'saveinsentif'])->name('rekap.gaji.insentif');
    
    // pengeluaran
    Route::get('/pengeluaran/{id_spj}', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran/{id_spj}', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/edit/{id_pengeluaran}', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{id_pengeluaran}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{id_pengeluaran}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');
    
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
    Route::get('/unit/{id}/edit', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');
});

// Crew routes
Route::middleware([isCrew::class])->group(function () {
    Route::get('/crew/dashboard', [UserController::class, 'index']);
    //update order
    Route::get('crew/dashboard', [CrewController::class, 'index'])->name('crew.dashboard');
    Route::get('crew/pesanan', [CrewController::class, 'pesanan'])->name('crew.pesanan');
    Route::get('crew/pesanan/detail_pesanan/{id}', [CrewController::class, 'detail'])->name('crew.detail_pesanan');
    Route::put('crew/pesanan/detail_pesanan/{id}/update-spj', [CrewController::class, 'updateSPJ'])->name('crew.pesanan.updateSPJ');
    
    //konsumbbm
    Route::get('crew/pesanan/detail_pesanan/bbm/{id_spj}', [CrewController::class, 'bbmindex'])->name('crew.bbm');
    Route::post('crew/pesanan/detail_pesanan/bbm/{id_spj}', [CrewController::class, 'bbmcreate'])->name('crew.bbm.create');
    Route::get('crew/pesanan/detail_pesanan/bbm/{idkonsumbbm}/edit-data', [CrewController::class, 'bbmgetEditData'])->name('crew.bbm.getEditData');
    Route::put('crew/pesanan/detail_pesanan/bbm/{idkonsumbbm}/edit', [CrewController::class, 'bbmedit'])->name('crew.bbm.edit');
    Route::delete('crew/pesanan/detail_pesanan/bbm/{id}', [CrewController::class, 'bbmdestroy'])->name('crew.bbm.destroy');
    
    // pengeluaran
    Route::get('crew/pesanan/detail_pesanan/pengeluaran/{id_spj}', [CrewController::class, 'pengeluaranindex'])->name('crew.pengeluaran');
    Route::post('crew/pesanan/detail_pesanan/pengeluaran/{id_spj}', [CrewController::class, 'pengeluaranstore'])->name('crew.pengeluaran.store');
    Route::get('crew/pesanan/detail_pesanan/pengeluaran/edit/{id_pengeluaran}', [CrewController::class, 'pengeluaranedit'])->name('crew.pengeluaran.edit');
    Route::put('crew/pesanan/detail_pesanan/pengeluaran/{id_pengeluaran}', [CrewController::class, 'pengeluaranupdate'])->name('crew.pengeluaran.update');
    Route::delete('crew/pesanan/detail_pesanan/pengeluaran/{id_pengeluaran}', [CrewController::class, 'pengeluarandestroy'])->name('crew.pengeluaran.destroy');
    //print
    
    // Jadwal
    Route::get('crew/events', [CrewController::class, 'showCalendar'])->name('crew.events');
    Route::get('crew/calendar', [CrewController::class, 'showMonthlyCalendar'])->name('crew.calendar');
});

Route::middleware([isViewer::class])->group(function () {
    // Viewer
    Route::get('viewer/dashboard', [ViewerController::class, 'index'])->name('viewer.dashboard');
    //pesanan
    Route::get('viewer/pesanan', [ViewerController::class, 'pesanan'])->name('viewer.pesanan');
    Route::get('viewer/pesanan/detail_pesanan/{id}', [ViewerController::class, 'detail'])->name('viewer.detail_pesanan');
    Route::get('viewer/calendar', [ViewerController::class, 'showMonthlyCalendar'])->name('viewer.calendar');
    //view data pesanan
});
Route::get('/total-bbm/{id_spj}', [OrderController::class, 'TotalBBM']);
Route::get('/total-uang-saku/{id_spj}', [OrderController::class, 'TotalPengeluaranUangSaku']);
Route::get('/total-sisa/{id_spj}', [OrderController::class, 'TotalSisa']);
Route::get('/view/{id}', [OrderController::class, 'view'])->name('view');
Route::get('/viewSJ/{id}', [OrderController::class, 'viewSJ'])->name('viewSJ');
Route::get('/viewSPJ/{id}', [OrderController::class, 'viewSPJ'])->name('viewSPJ');
Route::get('e-receipt/simaperkasya/{id}', [OrderController::class, 'show'])->name('e-receipt');
Route::get('/viewSPJ/{id}', [OrderController::class, 'viewSPJ'])->name('viewSPJ');
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

Route::get('/calendar/monthly', [CalendarController::class, 'showMonthlyCalendar'])->name('calendar.month');

Route::post('/calendar/update-availability', [CalendarController::class, 'updateAvailability'])->name('availability.update');

Route::get('/calendar/events', [CalendarController::class, 'showCalendar'])->name('calendar.events');

//Api Fetch Events
// Route::get('/tes', function () {
    //     return view('tes');
    // });
    Route::get('/api/events', [HomepageController::class,'index']);
    