<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Armada;
use App\Models\Unit;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    public function index(Request $request)
{
    $armadas = Armada::all();

    return view('manajemen_armada.index', compact('armadas'));
}

public function create()
{
    $akuns = Akun::where('role_id', 2)->get();
    $units = Unit::all();
    return view('manajemen_armada.create', compact('akuns', 'units'));
}


public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_akun' => 'required|exists:akun,id_akun',
        'id_unit' => 'required|exists:unit,id_unit',
        'posisi' => 'required',
        'status' => 'required',
        
    ]);

    Armada::create($validatedData);
    return redirect()->route('manajemen_armada.index')->with('success', 'Armada created successfully.');
}
public function edit($id)
{
    $armada = Armada::findOrFail($id);
    $akuns = Akun::where('id_akun', $armada->id_akun)->first();
    $units = Unit::where('id_unit',$armada->id_unit)->get();
    return view('manajemen_armada.edit', compact('armada', 'akuns', 'units'));
}


public function update(Request $request, $id)
{
    $armada = Armada::findOrFail($id);

    $validatedData = $request->validate([
        'id_akun' => 'required|exists:akun,id_akun', 
        'id_unit' => 'required|exists:unit,id_unit', 
        'posisi' => 'required|string|max:100',
        'status' => 'required|integer',
    ]);

    $armada->update($validatedData);

    return redirect()->route('manajemen_armada.index')->with('success', 'Armada updated successfully.');
}

public function destroy($id)
{
    $armada = Armada::findOrFail($id);
    $armada->delete();
    return redirect()->route('manajemen_armada.index')->with('success', 'Armada deleted successfully.');
}
}