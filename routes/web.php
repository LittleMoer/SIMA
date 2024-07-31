<?php

use Illuminate\Support\Facades\Route;

Route::get('/homepage', function () {
    return view('homepage');
});

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


