<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;


Route::resource('properties', PropertyController::class);


Route::get('/properti', function () {
    return view('/properti');
});

Route::get('/detail_properti', function () {
    return view('/detail_properti');
});

Route::get('/rayyan', function () {
    return view('/rayyan');
});

Route::get('/kontraktor', function () {
    return view('/kontraktor'); 
});

Route::get('/home', function () {
    return view('/home');
});

Route::get('/about', function () {
    return view('/about');
});

Route::get('/', [PropertyController::class, 'home'])->name('properties.home');
Route::get('/list', [PropertyController::class, 'list'])->name('properties.list');
Route::get('/dashboard', [PropertyController::class, 'index'])->name('properties.index');
Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
Route::get('/properties/filter', [PropertyController::class, 'filter'])->name('properties.filter');

Route::get('/detail/{id}', [PropertyController::class, 'show'])->name('properties.show');