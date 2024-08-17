<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use App\Models\Armada;

class ManajemenArmadaController extends Controller
{
    public function index()
    {
        $armadas = Armada::all();
        return view('manajemen_armada.show', compact('armadas'));
    }

    public function show(Request $request)
    {
        $request->validate([
            'id_armada' => 'required|string',
        ]);
    
        // Fetch the selected Armada
        $armada = Armada::findOrFail($request->id_armada);
    
        // Fetch the accounts (akun) associated with the selected Armada
        $akun = Akun::where('id_armada', $armada->id_armada)->get();
    
    
        return view('manajemen_armada.show', compact('armada', 'akun'));
    }
    
    
}