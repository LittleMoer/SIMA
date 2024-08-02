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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


