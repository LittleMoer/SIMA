<?php
namespace App\Http\Controllers;
use Illuminate\Support\Carbon; // Pastikan Carbon sudah diimport
use App\Models\Akun;
use App\Models\Rekapgajicrew;
use App\Models\Armada;
use App\Models\Sp;
use App\Models\Sj;
use App\Models\Spj;
use App\Models\Unit;
use App\Models\insentif;
use Illuminate\Http\Request;

class RekapGajiCrewController extends Controller
{
    public function showRekapGaji($id_armada)
{

    // Fetch the armada by ID with related akun and unit
    $armada = Armada::with('akun', 'unit')->findOrFail($id_armada);
    
    // Fetch the rekap gaji crew related to this armada
    $rekapGajiCrew = Rekapgajicrew::where('id_armada', $id_armada)->get();

    // Calculate totals
    $totalpremi = $rekapGajiCrew->sum('total_gaji');
    $totalharikerja = $rekapGajiCrew->sum('hari_kerja');
    $datainsentif = insentif::where('nama', $rekapGajiCrew->pluck('nama')->first())
                            ->where('bulan', $rekapGajiCrew->pluck('bulan')->first())
                            ->where('tahun', Carbon::parse($rekapGajiCrew->pluck('tanggal')->first())->year)
                            ->first();
    $insentif = $datainsentif ? $datainsentif->insentif : null;
    // dd($insentif, $datainsentif);
    // Calculate total bulanan then add insentif column from insentif table
    $totalbulanan = $rekapGajiCrew->sum('total_gaji') + $insentif;
    
    return view('rekap_gaji_crew.index', compact('armada', 'rekapGajiCrew', 'totalbulanan', 'totalpremi', 'totalharikerja', 'datainsentif'));
}
    
public function saveinsentif(Request $request, $id_armada)
{
    // Validate incoming request data
    $request->validate([
        'insentif' => 'required|numeric|min:0',
    ]);
    
    $rekapGajiCrew = Rekapgajicrew::where('id_armada', $id_armada)->get();
    //if insentif data is exist then update the insentif column else generate based on rekapgajicrew data
    $insentif = insentif::where('nama', $rekapGajiCrew->pluck('nama')->first())
                        ->where('bulan', $rekapGajiCrew->pluck('bulan')->first())
                        ->where('tahun', Carbon::parse($rekapGajiCrew->pluck('tanggal')->first())->year)
                        ->first();
    if ($insentif) {
        $insentif->update(['insentif' => $request->insentif]);
    } else {
        $distinctUsers = RekapGajiCrew::select('nama', 'bulan', 'tanggal')
                                      ->distinct()
                                      ->where('id_armada', $id_armada)
                                      ->get();
        
        foreach ($distinctUsers as $user) {
            $year = Carbon::parse($user->tanggal)->year; // Ambil tahun dari kolom tanggal
            
            Insentif::updateOrCreate(
                [
                    'nama' => $user->nama, 
                    'bulan' => $user->bulan, 
                    'tahun' => $year // Tambahkan kolom tahun
                ],
                [
                    'insentif' => $request->insentif
                ]
            );
        }
    }
    return redirect()->route('manajemen_armada.rekap_gaji', ['id_armada' => $id_armada])
                     ->with('success', 'Insentif berhasil disimpan.');
}

public function countWorkDays($tgl_keberangkatan, $tgl_kepulangan)
{
    $start = Carbon::parse($tgl_keberangkatan);
    $end = Carbon::parse($tgl_kepulangan);
    $allDays = $start->diffInDays($end) + 1; // Include the start and end date

    return $allDays;
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

    // get from spRecords that has tgl_keberangkatan between selected month and year
    $spRecords = SP::whereMonth('tgl_kepulangan', $selectedMonth)
                ->whereYear('tgl_kepulangan', $selectedYear)
                ->get(); 

    // get all records from sj that has id_sp equal to id_sp from spRecords, match the name in driver or driver2 or co_driver that equal to $nama 
    $sjRecords = SJ::whereIn('id_sp', $spRecords->pluck('id_sp')->toArray())
                ->where(function ($query) use ($nama) {
                    $query->whereIn('driver', $nama)
                          ->orWhereIn('driver2', $nama)
                          ->orWhereIn('codriver', $nama);
                })
                ->get();

// before generate clear rekapgajicrew table that has id_armada equal to id_armada from request
    RekapGajiCrew::where('id_armada', $request->id_armada)->delete();

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

            if ($jumlahArmada == 1) {
                $nilaiKontrak = $sp->nilai_kontrak1; 
            } else {
                    // Ambil semua SJ untuk SP ini dan urutkan berdasarkan ID.
                    $allSjForSp = SJ::where('id_sp', $sp->id_sp)
                                    ->orderBy('id_sj', 'asc')
                                    ->get();

                    // Jika SJ yang sedang diproses adalah SJ pertama dalam urutan, gunakan nilai_kontrak1.
                    if ($allSjForSp->isNotEmpty() && $allSjForSp->first()->id_sj == $sj->id_sj) {
                        $nilaiKontrak = $sp->nilai_kontrak1;
                    } else {
                        // Jika tidak, diasumsikan ini adalah armada kedua dan gunakan nilai_kontrak2.
                        $nilaiKontrak = $sp->nilai_kontrak2;
                    }
            }

            // Calculate total operational 
            $totalOperasional = $spj->totalisibbm + $spj->uangmakan + $spj->PenggunaanToll + $spj->uanglainlain;
            $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional;
            $totalGaji = $sisaNilaiKontrak;

            foreach ($namauser as $user) {
                if ($sj->driver2 != null && ($sj->driver2 === $user->name || $sj->driver === $user->name)) {
                    $premiPercentage = 10;
                } else {
                    $premiPercentage = $this->calculatePremiPercentage($seri, $posisi);
                }
                // Calculate base premium
                $basePremi = ($totalGaji * $premiPercentage) / 100;

                // Determine car wash price based on unit series
                $cuci = 0;
                if ($seri == 1) {
                    $cuci = 5000; // Seri 1: Rp 5.000
                } elseif ($seri == 2) {
                    $cuci = 5000;  // Seri 2: Rp 5.000
                } elseif ($seri == 3) {
                    $cuci = 7500;  // Seri 3: Rp 7.500
                }

                // Deduct car wash cost from premium
                $premi = max(0, $basePremi - $cuci); // Ensure premium doesn't go below 0

                // Prepare data to create
                $dataToCreate = [
                    'id_armada' => $armada->id_armada,
                    'nama' => $user->name,
                    'bulan' => $selectedMonth,
                    'tanggal' => $sp->tgl_kepulangan,
                    'hari_kerja' => $this->countWorkDays($sp->tgl_keberangkatan, $sp->tgl_kepulangan),
                    'nama_pemesanan' => $sp->nama_pemesan ?? 'Unknown',
                    'nilai_kontrak' => $nilaiKontrak,
                    'bbm' => $spj->totalisibbm,
                    'uang_makan' => $spj->uangmakan,
                    'parkir' => $spj->uanglainlain,
                    'cuci' => $cuci,
                    'toll' => $spj->PenggunaanToll,
                    'total_operasional' => $totalOperasional,
                    'sisa_nilai_kontrak' => $sisaNilaiKontrak,
                    'premi' => $premi,
                    'presentase_premi' => $premiPercentage,
                    'subsidi' => null,
                    'total_gaji' => $basePremi, // This already includes the car wash deduction
                ];
                try {
                    RekapGajiCrew::create($dataToCreate);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors('Error creating Rekap Gaji Crew entry: ' . $e->getMessage());
                }
            }
        }
    }

    // Insert data into insentif table
$distinctUsers = RekapGajiCrew::select('nama', 'bulan', 'tanggal')
                              ->distinct()
                              ->where('bulan', $selectedMonth)
                              ->get();

foreach ($distinctUsers as $user) {
    $year = Carbon::parse($user->tanggal)->year; // Ambil tahun dari kolom tanggal
    
    Insentif::updateOrCreate(
        [
            'nama' => $user->nama, 
            'bulan' => $user->bulan, 
            'tahun' => $year // Tambahkan kolom tahun
        ]
    );
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
    //fetch insentif data from insentif table where nama is equal to nama from rekapgajicrew and bulan is equal to bulan and tahun is equal to tahun from rekapgajicrew
    // $insentif = Insentif::where('nama', $rekapGajiCrew->pluck('nama')->toArray())
    //                     ->where('bulan', $rekapGajiCrew->pluck('bulan')->toArray())
    //                     ->where('tahun', $rekapGajiCrew->pluck('tahun')->toArray())
    //                     ->get();
    // $totalpremi = Rekapgajicrew::where('id_armada', $id_armada)->sum('premi');
    // $totalharikerja = Rekapgajicrew::where('id_armada', $id_armada)->sum('hari_kerja');
    // $totalbulanan = Rekapgajicrew::where('id_armada', $id_armada)->sum('total_gaji') + $insentif->insentif;
    
    return view('rekap_gaji_crew.edit', compact('armada', 'rekapGajiCrew'));
}

public function update(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'id_armada' => 'required|integer',
        'data' => 'required|array',
        'data.*.id_rekapgajicrew' => 'required|integer',
        'data.*.tanggal' => 'required|date',
        'data.*.hari_kerja' => 'required|integer',
        'data.*.nama_pemesanan' => 'required|string|max:255',
        'data.*.nilai_kontrak_hidden' => 'required|numeric|min:0', // Validate the hidden input for nilai_kontrak
        'data.*.bbm_hidden' => 'nullable|numeric|min:0', // Validate the hidden input for bbm
        'data.*.uang_makan_hidden' => 'nullable|numeric|min:0', // Validate the hidden input for uang_makan
        'data.*.parkir_hidden' => 'nullable|numeric|min:0', // Validate the hidden input for parkir
        'data.*.cuci_hidden' => 'nullable|numeric|min:0', // Validate the hidden input for cuci
        'data.*.toll_hidden' => 'nullable|numeric|min:0', // Validate the hidden input for toll
        'data.*.subsidi_hidden' => 'nullable|numeric|min:0', // Validate the hidden input for subsidi
        'data.*.premium_percentage' => 'nullable',
    ]);

    // Loop through the submitted data to update each record
    foreach ($request->data as $rekapData) {
        // Find the record based on 'id_rekapgajicrew'
        $rekapGaji = RekapGajiCrew::findOrFail($rekapData['id_rekapgajicrew']);

        // Calculate total operational costs using hidden values
        $totalOperasional = ($rekapData['bbm_hidden'] ?? 0) + 
                            ($rekapData['uang_makan_hidden'] ?? 0) + 
                            ($rekapData['cuci_hidden'] ?? 0) + 
                            ($rekapData['toll_hidden'] ?? 0) + 
                            ($rekapData['parkir_hidden'] ?? 0);

        // Use the hidden nilai_kontrak value
        $nilaiKontrak = $rekapData['nilai_kontrak_hidden']; // This should be a numeric value

        // Determine the remaining contract value
        $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional;

        // Handle premium percentage
        $premiPercentage = ($rekapData['premium_percentage'] === 'custom' && !empty($rekapData['custom_premium']))
            ? (int)$rekapData['custom_premium'] // Ensure custom_premium is treated as an integer
            : (int)($rekapData['premium_percentage'] ?? 0); // Fallback to 0 if not set

        // Calculate base premium
        $basePremi = ($sisaNilaiKontrak * $premiPercentage) / 100;
        
        // Get car wash cost
        $cuci = (int)($rekapData['cuci_hidden'] ?? 0);
        
        // Deduct car wash cost from premium (ensure it doesn't go below 0)
        $premi = max(0, $basePremi - $cuci);
        
        // Calculate total gaji including subsidy
        $totalGaji = $premi + ($rekapData['subsidi_hidden'] ?? 0);

        // Update the record
        $rekapGaji->update(array_merge($rekapData, [
            'nilai_kontrak' => $nilaiKontrak, // Ensure this is the hidden value
            'bbm' => $rekapData['bbm_hidden'], // Use the hidden value for bbm
            'uang_makan' => $rekapData['uang_makan_hidden'], // Use the hidden value for uang_makan
            'parkir' => $rekapData['parkir_hidden'], // Use the hidden value for parkir
            'cuci' => $rekapData['cuci_hidden'], // Use the hidden value for cuci
            'toll' => $rekapData['toll_hidden'], // Use the hidden value for toll
            'subsidi' => $rekapData['subsidi_hidden'], // Use the hidden value for subsidi
            'total_gaji' => $totalGaji,
            'total_operasional' => $totalOperasional,
            'sisa_nilai_kontrak' => $sisaNilaiKontrak,
            'premi' => $premi,
            'presentase_premi' => $premiPercentage
        ]));
    }

    // Redirect back with a success message
    return redirect()->route('manajemen_armada.rekap_gaji', ['id_armada' => $request->id_armada])
                     ->with('success', 'Rekap Gaji Crew successfully updated.');
}
}
