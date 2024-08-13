<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapGajiCrew;
use App\Models\Armada;
use App\Models\SP;
use App\Models\SJ;
use App\Models\SPJ;
use App\Models\KonsumBbm;
use Carbon\Carbon;

class RekapGajiCrewController extends Controller
{
    public function index()
    {
        $armadas = Armada::all();
        return view('rekap_gaji_crew.index', compact('armadas'));
    }

    public function show(Request $request)
    {
        $request->validate([
            'id_armada' => 'required|string',
        ]);

        $armada = Armada::findOrFail($request->id_armada);
        $rekapGaji = RekapGajiCrew::where('nama', $armada->driver)
                        ->orWhere('nama', $armada->codriver)
                        ->get();

        return view('rekap_gaji_crew.show', compact('rekapGaji', 'armada'));
    }
    public function generatePayrollSummary(Request $request)
    {
        $request->validate([
            'id_armada' => 'required|string',
        ]);

        $armada = Armada::findOrFail($request->id_armada);
        
        // Fetch SPJ records associated with the selected Armada
        $spjRecords = SPJ::where('id_armada', $armada->id_armada)->get();

        // dd($spjRecords);
        foreach ($spjRecords as $spj) {
            // Create a new Rekap Gaji Crew entry
            RekapGajiCrew::create([
                'nama' => $armada->driver, // or codriver
                'crew' => $armada->id_armada, 
                'bulan' => date('F'),
                'no' => $spj->id,
                'tanggal' => $spj->created_at->format('Y-m-d'), // Assuming 'created_at' as the departure date
                'pj_rombongan' => $spj->pj_rombongan, // or fetch from related SPJ record
                'nilai_kontrak' => $spj->nilai_kontrak,
                'total_operasional' => $spj->total_operasional,
                'sisa_nilai_kontrak' => $spj->sisa_nilai_kontrak,
                'total_gaji' => $spj->nilai_kontrak, // Modify as per actual calculation
            ]);
        }

        return redirect()->route('rekap.gaji.show', ['id_armada' => $armada->id_armada])
                         ->with('success', 'Rekap Gaji Crew berhasil di-generate');
    }
}

