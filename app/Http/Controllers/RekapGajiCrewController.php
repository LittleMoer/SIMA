<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use App\Models\RekapGajiCrew;
use App\Models\Armada;
use App\Models\SP;
use App\Models\SJ;
use App\Models\SPJ;
use App\Models\Unit;


class RekapGajiCrewController extends Controller
{
    public function showRekapGaji($id_armada)
    {
        // Fetch the armada by ID
        $armada = Armada::with('akun', 'unit')->findOrFail($id_armada);
        
        // Fetch the rekap gaji crew related to this armada
        $rekapGajiCrew = RekapGajiCrew::where('id_armada', $id_armada)->get();
        
        return view('rekap_gaji_crew.index', compact('armada', 'rekapGajiCrew'));
    }
    
    public function countWorkDays($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $end->modify('+1 day');
        $interval = $end->diff($start);
        $days = $interval->days;

        $period = new \DatePeriod($start, new \DateInterval('P1D'), $end);
        $workdays = 0;

        foreach ($period as $dt) {
            if ($dt->format('N') < 6) {
                $workdays++;
            }
        }

        return $workdays;
    }

    public function show(Request $request)
    {
        $request->validate([
            'id_armada' => 'required|string',
        ]);
    
        // Fetch the selected Armada
        $armada = Armada::findOrFail($request->id_armada);
    
        // Fetch the accounts (akun) associated with the selected Armada
        $akun = Akun::where('id_akun', $armada->id_akun)->get();
        $nama = $akun->pluck('name');
        // Fetch Rekap Gaji Crew based on the driver and codriver's names in the retrieved accounts
        $rekapGaji = RekapGajiCrew::whereIn('nama', $akun->pluck('name'))->get();
    
        return view('rekap_gaji_crew.index', compact('rekapGaji', 'armada', 'akun'));
    }
    
    public function generate(Request $request)
    {
        $request->validate([
            'id_armada' => 'required|string',
            'bulan' => 'required|string',
        ]);
    

        $sjRecords = SJ::where('id_unit', $request->id_armada)->get();
        $selectedMonth = $request->input('bulan');
        
        if ($sjRecords->isEmpty()) {
            return redirect()->back()->withErrors('No SJ records found for the selected Armada.');
        }
    

        RekapGajiCrew::where('id_armada', $request->id_armada)
            ->where('bulan', $selectedMonth)
            ->delete();
    
        foreach ($sjRecords as $sj) {

            $sp = SP::where('id_sp', $sj->id_sp)->first();
            

            $unit = Unit::where('id_unit', $sj->id_unit)->first();
            $seri = $unit->seri; 
            $akun = Akun::where('id_akun', $sj->driver)->get();
            $spj = SPJ::where('id_sj', $sj->id_sj)->first();
            $nilaiKontrak = $sj->nilai_kontrak ?? 0;
            $totalOperasional = $spj ? $spj->total_operasional : 0;
            $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional;
            $totalGaji = $nilaiKontrak; 
            

            foreach ($akun as $user) {
  
                $premiPercentage = 0;
    
                // Apply the premi based on seri and posisi
                if ($seri == 1 && $user->posisi == 'Driver') {
                    // Seri 1: Driver only - cut 21% from total pendapatan
                    $premiPercentage = 21;
                } elseif ($seri == 2) {
                    // Seri 2: Driver gets 14%, Co-Driver gets 7%
                    $premiPercentage = ($user->posisi == 'Driver') ? 14 : 7;
                } elseif ($seri == 3) {
                    // Seri 3: Driver gets 12%, Co-Driver gets 6%
                    $premiPercentage = ($user->posisi == 'Driver') ? 12 : 6;
                }
    
                // Calculate the premi based on the percentage
                $premi = ($totalGaji * $premiPercentage) / 100;
    
                // Create new Rekap Gaji Crew entry
                RekapGajiCrew::create([
                    'no_rekap' => RekapGajiCrew::count() + 1,
                    'id_armada' => $sj->id_unit,
                    'nama' => $user->name,
                    'bulan' => $selectedMonth,
                    'tanggal' => $sj->created_at->format('Y-m-d'),
                    'hari_kerja' => $this->countWorkDays($sp->tgl_keberangkatan, $sp->tgl_kepulangan),
                    'pj_rombongan' => $sp->pj_rombongan ?? 'Unknown',
                    'nilai_kontrak' => $nilaiKontrak,
                    'bbm' => $spj->bbm ?? null,
                    'uang_makan' => $spj->uang_makan ?? null,
                    'parkir' => $spj->parkir ?? null,
                    'cuci' => $spj->cuci ?? null,
                    'toll' => $spj->toll ?? null,
                    'total_operasional' => $totalOperasional,
                    'sisa_nilai_kontrak' => $sisaNilaiKontrak,
                    'premi' => $premi,
                    'subsidi' => $spj->subsidi ?? null,
                    'total_gaji' => $totalGaji,
                ]);
            }
        }
    
        return redirect()->route('manajemen_armada.rekap_gaji', ['id_armada' => $request->id_armada])
                         ->with('success', 'Rekap Gaji Crew berhasil di-generate');
    }
    
    public function edit($no_rekap, $nama)
    {
        $rekapGaji = RekapGajiCrew::where('no_rekap', $no_rekap)
            ->where('nama', $nama)
            ->firstOrFail();
    
        return view('rekap_gaji_crew.edit', compact('rekapGaji'));
    }

    public function update(Request $request, $no_rekap, $nama)
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
    
        // Find the record based on 'no' (no_rekap) and 'nama'
        $rekapGaji = RekapGajiCrew::where('no_rekap', $no_rekap)
            ->where('nama', $nama)
            ->firstOrFail();
    
        // Update the record with validated data
        $rekapGaji->update($validatedData);
    
        return redirect()->route('rekap.gaji.show', ['id_armada' => $rekapGaji->crew])
            ->with('success', 'Rekap Gaji Crew berhasil diperbarui');
    }    
}

