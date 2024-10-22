<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    // Function untuk menampilkan view tambah unit dan daftar unit
    public function index()
    {
        $units = Unit::all();
        return view('unit.index', compact('units'));
    }

    // Function untuk menambahkan unit baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'seri_unit' => 'required|integer|in:1,2,3',
        ]);

        // Menentukan nama unit baru berdasarkan seri_unit
        $seri = $request->input('seri_unit');
        $latestUnit = Unit::where('seri_unit', $seri)->orderBy('nama_unit', 'desc')->first();

        if ($latestUnit) {
            // Mengambil angka terakhir dari nama_unit dan menambahkannya
            $lastNumber = intval(substr($latestUnit->nama_unit, 4));
            $newNumber = $lastNumber + 1;
        } else {
            // Jika belum ada unit, mulai dari 101, 201, atau 301
            $newNumber = $seri * 100 + 1;
        }

        // Format nama unit (contoh: JSP-101)
        $nama_unit = 'JSP-' . $newNumber;

        // Simpan unit baru ke database
        Unit::create([
            'nama_unit' => $nama_unit,
            'seri_unit' => $seri,
        ]);

        // Redirect kembali ke halaman list unit
        return redirect()->route('unit.index')->with('success', 'Unit berhasil ditambahkan');
    }

    // Function untuk mengedit unit
    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('unit.edit', compact('unit'));
    }



    // Function untuk mengupdate unit
    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);

        $request->validate([
            'nama_unit' => 'required',
            'seri_unit' => 'required|integer|in:1,2,3',
        ]);

        $unit->update([
            'nama_unit' => $request->input('nama_unit'),
            'seri_unit' => $request->input('seri_unit'),
        ]);

        return redirect()->route('unit.index')->with('success', 'Unit berhasil diperbarui');
    }

    // Function untuk menghapus unit
    public function destroy($id)
    {
        Unit::destroy($id);
        return redirect()->route('unit.index')->with('success', 'Unit berhasil dihapus');
    }
}
