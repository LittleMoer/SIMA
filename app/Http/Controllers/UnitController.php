<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $units = Unit::all();
        return view('unit.index', compact('units'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required|string|max:50|unique:unit',
            'seri_unit' => 'required|integer',
        ]);
        Unit::create([
            'nama_unit' => $request->nama_unit,
            'seri_unit' => $request->seri_unit,
        ]);
        return redirect()->route('unit.index')->with('success', 'Unit created successfully.');
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
    
        $validatedData = $request->validate([
            'nama_unit' => 'required|string',
            'seri_unit' => 'required|integer',
        ]);
    
        $unit->update($validatedData);
    
        return redirect()->route('unit.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('unit.index')->with('success', 'Unit deleted successfully.');
    }
}
