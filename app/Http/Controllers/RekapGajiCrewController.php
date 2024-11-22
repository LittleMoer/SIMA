<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Rekapgajicrew;
use App\Models\Armada;
use App\Models\SP;
use App\Models\SJ;
use App\Models\SPJ;
use App\Models\Unit;
use Illuminate\Http\Request;

class RekapGajiCrewController extends Controller
{
    public function showRekapGaji($id_armada)
{
    // Start the session
    session_start();

    // Fetch the armada by ID with related akun and unit
    $armada = Armada::with('akun', 'unit')->findOrFail($id_armada);
    
    // Fetch the rekap gaji crew related to this armada
    $rekapGajiCrew = Rekapgajicrew::where('id_armada', $id_armada)->get();

    // Calculate totals
    $totalpremi = $rekapGajiCrew->sum('premi');
    $totalharikerja = $rekapGajiCrew->sum('hari_kerja');

    // Get insentif from session or default to 0
    $insentif = isset($_SESSION['insentif']) ? $_SESSION['insentif'] : 0;

    // Calculate total bulanan
    $totalbulanan = $rekapGajiCrew->sum('total_gaji') + $insentif;
    
    return view('rekap_gaji_crew.index', compact('armada', 'rekapGajiCrew', 'totalbulanan', 'totalpremi', 'totalharikerja', 'insentif'));
}
    
    public function updateint(Request $request, $id_armada)
{
    // Validate incoming request data
    $request->validate([
        'insentif' => 'nullable|integer',
    ]);

    // Store insentif in session
    session(['insentif' => $request->insentif]);

    // Return a JSON response
    return response()->json(['success' => true, 'insentif' => session('insentif')]);
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

    public function calculatePremiPercentage($seri, $posisi)
{
    $premiPercentage = 0;

    switch ($seri) {
        case 1:
            if ($posisi === 'Driver') {
                $premiPercentage = 21; 
            }
            break;
        case 2:
            if ($posisi === 'Driver') {
                $premiPercentage = 14; 
            } elseif ($posisi === 'Co-Driver') {
                $premiPercentage = 7; 
            }
            break;
        case 3:
            if ($posisi === 'Driver') {
                $premiPercentage = 12; 
            } elseif ($posisi === 'Co-Driver') {
                $premiPercentage = 6;
            }
            break;
    }

    return $premiPercentage; 
}

public function generate(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'id_armada' => 'required|string',
        'bulan' => 'required|string',
        'tahun' => 'required|integer',
    ]);

    // Fetch selected month and year from the request
    $selectedMonth = $request->input('bulan');
    $selectedYear = $request->input('tahun');

    // Retrieve the armada including akun
    $armada = Armada::with('akun')->findOrFail($request->id_armada);
    $posisi = Armada::find($armada->id_armada)->posisi;

    // Get the id_akun from the armada
    $idAkun = $armada->id_akun; 
    $namauser = Akun::where('id_akun', $idAkun)->get();
    $nama = $namauser->pluck('name')->toArray(); 

    // Fetch SJ records for the given armada filtered by month, year, and driver/codriver names
    $sjRecords = SJ::where('id_unit', $armada->id_unit)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->where(function($query) use ($nama) {
            $query->whereIn('driver', $nama)
                  ->orWhereIn('codriver', $nama);
        })
        ->get();

        RekapGajiCrew::where('id_armada', $request->id_armada)
        ->where('bulan', $selectedMonth)
        ->whereYear('tanggal', $selectedYear)
        ->delete();

    if ($sjRecords->isEmpty()) {
        return redirect()->back()->withErrors('No SJ records found for the selected month, year, and drivers.');
    } else {
        // Initialize an array to store the rekap gaji crew records
        $rekapGajiCrewRecords = [];

        // Loop through the SJ records
        foreach ($sjRecords as $sj) {
            // Fetch the SP associated with SJ
            $sp = SP::find($sj->id_sp); 
            $spj = SPJ::where('id_sj', $sj->id_sj)->first();
            $unit = Unit::where('id_unit', $armada->id_unit)->first();
            $seri = $unit->seri_unit;
            

            if (!$sp) {
                return redirect()->back()->withErrors('SP not found for SJ with ID: '.$sj->id_sj);
            }

            $jumlahArmada = $sp->jumlah_armada;

            if ($jumlahArmada < 1) {
                $nilaiKontrak = $sp->nilai_kontrak1; 
            } else {
                $sjcompare = SJ::where('id_sp', $sp->id_sp)
                    ->where('id_unit', $armada->id_unit)
                    ->where('id_sj', '!=', $sj->id_sj)
                    ->first();
                if ($sjcompare > $sj->id_sj) {
                    $nilaiKontrak = $sp->nilai_kontrak2;
                } else {
                    $nilaiKontrak = $sp->nilai_kontrak1;
                }
            }

            $totalOperasional = $spj->totalisibbm + $spj->uangmakan + $spj->PenggunaanToll;
            $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional;
            $totalGaji = $nilaiKontrak;

            foreach ($namauser as $user) {
                $premiPercentage = $this->calculatePremiPercentage($seri, $posisi);
                $premi = ($totalGaji * $premiPercentage) / 100;

                // Prepare data to create
                $dataToCreate = [
                    'id_armada' => $armada->id_armada,
                    'nama' => $user->name,
                    'bulan' => $selectedMonth,
                    'tanggal' => $sp->tgl_keberangkatan,
                    'hari_kerja' => $this->countWorkDays($sp->tgl_keberangkatan, $sp->tgl_kepulangan),
                    'nama_pemesanan' => $sp->nama_pemesan ?? 'Unknown',
                    'nilai_kontrak' => $nilaiKontrak,
                    'bbm' => $spj->totalisibbm,
                    'uang_makan' => $spj->uangmakan,
                    'parkir' => null,
                    'cuci' => null,
                    'toll' => $spj->PenggunaanToll,
                    'total_operasional' => $totalOperasional,
                    'sisa_nilai_kontrak' => $sisaNilaiKontrak,
                    'premi' => $premi,
                    'subsidi' => null, 
                    'total_gaji' => $premi,
                ];

                try {
                    RekapGajiCrew::create($dataToCreate);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('Error creating Rekap Gaji Crew entry: ' . $e->getMessage());
                }
            }
        }
    }

    return redirect()->route('manajemen_armada.rekap_gaji', ['id_armada' => $request->id_armada])
                     ->with('success', 'Rekap Gaji Crew berhasil di-generate');
}

public function edit($id_armada)
{
    // Fetch the armada by ID with related akun and unit
    $armada = Armada::with('akun', 'unit')->findOrFail($id_armada);

    // Fetch the rekap gaji crew related to this armada using the correct property
    $rekapGajiCrew = Rekapgajicrew::where('id_armada', $id_armada)->get();

    $totalpremi = Rekapgajicrew::where('id_armada', $id_armada)->sum('premi');
    $totalharikerja = Rekapgajicrew::where('id_armada', $id_armada)->sum('hari_kerja');
    $insentif = 0;
    $totalbulanan = Rekapgajicrew::where('id_armada', $id_armada)->sum('total_gaji') + $insentif;
    
    return view('rekap_gaji_crew.edit', compact('armada', 'rekapGajiCrew', 'totalbulanan', 'totalpremi', 'totalharikerja', 'insentif'));
}

public function update(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'id_armada' => 'required|string',
        'data' => 'required|array',
        'data.*.id_rekapgajicrew' => 'required|integer',
        'data.*.tanggal' => 'required|date',
        'data.*.hari_kerja' => 'required|integer',
        'data.*.nama_pemesanan' => 'nullable|string',
        'data.*.nilai_kontrak' => 'nullable|integer',
        'data.*.bbm' => 'nullable|integer',
        'data.*.uang_makan' => 'nullable|integer',
        'data.*.parkir' => 'nullable|integer',
        'data.*.cuci' => 'nullable|integer',
        'data.*.toll' => 'nullable|integer',
        'data.*.premium_percentage' => 'nullable|integer', 
        'data.*.custom_premium' => 'nullable|integer', 
        'data.*.subsidi' => 'nullable|integer',
    ]);

    // Loop through the submitted data to update each record
    foreach ($request->data as $rekapData) {
        // Find the record based on 'id_rekapgajicrew'
        $rekapGaji = RekapGajiCrew::findOrFail($rekapData['id_rekapgajicrew']);

        // Calculate total operational costs
        $totalOperasional = ($rekapData->bbm ?? 0) + ($rekapData->uang_makan ?? 0) + ($rekapData->toll ?? 0);
        
        // Determine nilai kontrak from the record
        $sisaNilaiKontrak = $rekapData['nilai_kontrak'] - $totalOperasional;

        // Determine the correct premium percentage
        $premiPercentage = ($rekapData['premium_percentage'] === 'custom' && !empty($rekapData['custom_premium']))
            ? $rekapData['custom_premium'] 
            : $rekapData['premium_percentage'];

        // Calculate the premium based on total gaji from the form
        $premi = ($sisaNilaiKontrak * $premiPercentage) / 100; 
        $totalGaji = $premi + $rekapData['subsidi']; 
        // Update the record
        $rekapGaji->update(array_merge($rekapData, [
            'total_gaji' => $totalGaji,
            'total_operasional' => $totalOperasional,
            'sisa_nilai_kontrak' => $sisaNilaiKontrak,
            'premi' => $premi,
        ]));
    }
    // Redirect back with a success message
    return redirect()->route('manajemen_armada.rekap_gaji', ['id_armada' => $request->id_armada])
                     ->with('success', 'Rekap Gaji Crew successfully updated.');
}
}

