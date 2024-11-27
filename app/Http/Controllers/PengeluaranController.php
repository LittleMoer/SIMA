<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranUangSaku;
use App\Models\Spj;
use App\Models\Sj;
use App\Models\Sp;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    // Menampilkan daftar pengeluaran uang saku berdasarkan id_spj
    public function index($id_spj)
    {
        
        $spj = Spj::where('id_spj', $id_spj)->first();
        $sj = SJ::where('id_sj', $spj->id_sj)->first();
        $id_sp = $sj->id_sp;
        $pengeluaran = PengeluaranUangSaku::where('id_spj', $id_spj)->get();
        return view('pengeluaran.index', compact('spj', 'id_sp', 'sj', 'pengeluaran'));
    }

    // Menambahkan pengeluaran uang saku baru
    public function store(Request $request, $id_spj)
    {
        $validatedData = $request->validate([
            'nominal' => 'nullable|numeric',
            'catatan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $validatedData['id_spj'] = $id_spj;
        PengeluaranUangSaku::create($validatedData);

        return redirect()->route('pengeluaran.index', $id_spj)->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    // Menampilkan form untuk edit pengeluaran
    public function edit($id_pengeluaran)
    {
        $pengeluaran = PengeluaranUangSaku::findOrFail($id_pengeluaran);
        return response()->json($pengeluaran);
    }

    // Memperbarui data pengeluaran uang saku
    public function update(Request $request, $id_pengeluaran)
    {
        $pengeluaran = PengeluaranUangSaku::findOrFail($id_pengeluaran);

        $validatedData = $request->validate([
            'nominal' => 'required|numeric',
            'catatan' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        $pengeluaran->update($validatedData);

        return redirect()->route('pengeluaran.index', $pengeluaran->id_spj)->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    // Menghapus pengeluaran uang saku
    public function destroy($id_pengeluaran)
    {
        $pengeluaran = PengeluaranUangSaku::findOrFail($id_pengeluaran);
        $pengeluaran->delete();

        return back()->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
