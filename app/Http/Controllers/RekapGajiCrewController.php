<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use App\Models\RekapGajiCrew;
use App\Models\Armada;
use App\Models\SP;
use App\Models\SJ;
use App\Models\SPJ;
use App\Models\KonsumBbm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
    
        // Fetch the selected Armada
        $armada = Armada::findOrFail($request->id_armada);
    
        // Fetch the accounts (akun) associated with the selected Armada
        $akun = Akun::where('id_armada', $armada->id_armada)->get();
    
        // Fetch Rekap Gaji Crew based on the driver and codriver's names in the retrieved accounts
        $rekapGaji = RekapGajiCrew::whereIn('nama', $akun->pluck('name'))->get();
    
        return view('rekap_gaji_crew.show', compact('rekapGaji', 'armada', 'akun'));
    }
    
    public function generatePayrollSummary(Request $request)
    {
        $request->validate([
            'id_armada' => 'required|string',
            'bulan' => 'required|string',
        ]);
    
        $armada = Armada::findOrFail($request->id_armada);
        $akun = Akun::where('id_armada', $armada->id_armada)->get();
        $selectedMonth = $request->input('bulan');
        
        // Fetch SJ records associated with the selected Armada and month
        $sjRecords = SJ::where('id_armada', $armada->id_armada)->get();
    
        // Clear existing records if needed
        RekapGajiCrew::where('crew', $armada->id_armada)
            ->where('bulan', $selectedMonth)
            ->delete();
    
        foreach ($sjRecords as $sj) {
            // Retrieve the related SP record
            $sp = SP::where('id_sp', $sj->id_sp)->first();
    
            foreach ($akun as $user) {
                $spj = SPJ::where('id_sj', $sj->id_sj)->first();
                
                // Calculate or fetch required values
                $nilaiKontrak = $sj->nilai_kontrak;
                $totalOperasional = $spj ? $spj->total_operasional : 0;
                $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional; // Example calculation
                $totalGaji = $nilaiKontrak; // Modify as per actual calculation
                
                // Create a new Rekap Gaji Crew entry
                RekapGajiCrew::create([
                    'nama' => $user->name,
                    'crew' => $armada->id_armada,
                    'bulan' => $selectedMonth,
                    'tanggal' => $sj->created_at->format('Y-m-d'),
                    'pj_rombongan' => $sp->pj_rombongan ?? 'Unknown',
                    'nilai_kontrak' => $nilaiKontrak,
                    'bbm' => $spj->bbm ?? null,
                    'uang_makan' => $spj->uang_makan ?? null,
                    'parkir' => $spj->parkir ?? null,
                    'cuci' => $spj->cuci ?? null,
                    'toll' => $spj->toll ?? null,
                    'total_operasional' => $totalOperasional,
                    'sisa_nilai_kontrak' => $sisaNilaiKontrak,
                    'premi' => $spj->premi ?? null,
                    'subsidi' => $spj->subsidi ?? null,
                    'total_gaji' => $totalGaji,
                ]);
            }
        }


        return redirect()->route('rekap.gaji.show', ['id_armada' => $armada->id_armada])
                         ->with('success', 'Rekap Gaji Crew berhasil di-generate');
    }
    public function edit($nama)
    {
        // Ambil data Rekap Gaji Crew berdasarkan nama
        $rekapGaji = RekapGajiCrew::where('nama', $nama)->firstOrFail();
    
        return view('rekap_gaji_crew.edit', compact('rekapGaji'));
    }
    

    public function update(Request $request, $nama)
{
    $validatedData = $request->validate([
        'tanggal' => 'required|date',
        'pj_rombongan' => 'required|string|max:255',
        'nilai_kontrak' => 'required|integer',
        'bbm' => 'nullable|integer',
        'uang_makan' => 'nullable|integer',
        'parkir' => 'nullable|integer',
        'cuci' => 'nullable|integer',
        'toll' => 'nullable|integer',
        'total_operasional' => 'nullable|integer',
        'sisa_nilai_kontrak' => 'nullable|integer',
        'premi' => 'nullable|integer',
        'subsidi' => 'nullable|integer',
        'total_gaji' => 'nullable|integer',
    ]);

    $rekapGaji = RekapGajiCrew::where('nama', $nama)->firstOrFail();
    $rekapGaji->update($request->all());

    return redirect()->route('rekap.gaji.show', ['id_armada' => $rekapGaji->crew])
                     ->with('success', 'Rekap Gaji Crew berhasil diperbarui');
}    
}

