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
    
        // Clear existing records if needed
        RekapGajiCrew::where('crew', $armada->id_armada)->delete();
    
        foreach ($spjRecords as $spj) {
            // Retrieve the related SJ record
            $sj = SJ::where('id_sj', $spj->id_sj)->first();
    
            // Retrieve the related SP record
            $sp = SP::where('id_sp', $sj->id_sp)->first();
    
            // Calculate or fetch required values
            $nilaiKontrak = $sj->nilai_kontrak;
            $totalOperasional = $spj ? $spj->total_operasional : 0;
            $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional; // Example calculation
            $totalGaji = $nilaiKontrak; // Modify as per actual calculation
    
            // Create a new Rekap Gaji Crew entry
            RekapGajiCrew::create([
                'nama' => $armada->driver, // or codriver
                'crew' => $armada->id_armada,
                'bulan' => date('F'),
                'no' => RekapGajiCrew::count() + 1,
                'tanggal' => $spj->created_at->format('Y-m-d'),
                'pj_rombongan' => $sp->pj_rombongan ?? 'Unknown',
                'nilai_kontrak' => $nilaiKontrak,
                'total_operasional' => $totalOperasional,
                'sisa_nilai_kontrak' => $sisaNilaiKontrak,
                'total_gaji' => $totalGaji,
            ]);
        }
    
        return redirect()->route('rekap.gaji.show', ['id_armada' => $armada->id_armada])
                         ->with('success', 'Rekap Gaji Crew berhasil di-generate');
    }
      
}

