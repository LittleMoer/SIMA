<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    // Menambahkan middleware 'auth' di constructor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard', [
            'username' => session('username'),
        ]);
    }
}
