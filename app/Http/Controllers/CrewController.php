<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }
}
