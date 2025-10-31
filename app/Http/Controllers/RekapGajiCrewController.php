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
                    'premi' => $basePremi,
                    'presentase_premi' => $premiPercentage,
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
    // For each rekap entry, compute a fallback presentase (percentage) using SP/SJ and Armada/Unit
    foreach ($rekapGajiCrew as $gaji) {
        $computedPercentage = null;
        // try to find SJ that matches this record by tanggal and nama
        $spCandidates = SP::whereDate('tgl_kepulangan', $gaji->tanggal)->get();
        if ($spCandidates->isNotEmpty()) {
            $sj = SJ::whereIn('id_sp', $spCandidates->pluck('id_sp')->toArray())
                    ->where(function ($q) use ($gaji) {
                        $q->where('driver', $gaji->nama)
                          ->orWhere('driver2', $gaji->nama)
                          ->orWhere('codriver', $gaji->nama);
                    })
                    ->first();

            if ($sj) {
                $arm = Armada::find($gaji->id_armada);
                $unit = $arm ? Unit::where('id_unit', $arm->id_unit)->first() : null;
                $seri = $unit ? $unit->seri_unit : null;
                $posisi = $arm ? $arm->posisi : null;

                if ($sj->driver2 != null && ($sj->driver2 === $gaji->nama || $sj->driver === $gaji->nama)) {
                    $computedPercentage = 10;
                } else {
                    $computedPercentage = $this->calculatePremiPercentage($seri, $posisi);
                }
            }
        }

        // attach computed value to model instance for view use
        $gaji->computed_presentase = $computedPercentage;
    }
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

        // Try to recompute values using SP / SJ / SPJ and Armada/Unit similar to generate()
        $tanggal = $rekapData['tanggal'] ?? $rekapGaji->tanggal;
        $crewName = $rekapGaji->nama;

        // Find SPs that have the same tgl_kepulangan
        $spCandidates = SP::whereDate('tgl_kepulangan', $tanggal)->get();
        $computed = false;

        if ($spCandidates->isNotEmpty()) {
            // Find SJ that matches this crew name within those SPs
            $sj = SJ::whereIn('id_sp', $spCandidates->pluck('id_sp')->toArray())
                    ->where(function ($q) use ($crewName) {
                        $q->where('driver', $crewName)
                          ->orWhere('driver2', $crewName)
                          ->orWhere('codriver', $crewName);
                    })
                    ->first();

            if ($sj) {
                $sp = SP::find($sj->id_sp);
                $spj = SPJ::where('id_sj', $sj->id_sj)->first();
                $armada = Armada::find($rekapGaji->id_armada);
                $unit = $armada ? Unit::where('id_unit', $armada->id_unit)->first() : null;
                $seri = $unit ? $unit->seri_unit : null;
                $posisi = $armada ? $armada->posisi : null;

                // Determine nilai kontrak similar to generate()
                $jumlahArmada = $sp->jumlah_armada;
                if ($jumlahArmada == 1) {
                    $nilaiKontrak = $sp->nilai_kontrak1;
                } else {
                    $allSjForSp = SJ::where('id_sp', $sp->id_sp)->orderBy('id_sj', 'asc')->get();
                    if ($allSjForSp->isNotEmpty() && $allSjForSp->first()->id_sj == $sj->id_sj) {
                        $nilaiKontrak = $sp->nilai_kontrak1;
                    } else {
                        $nilaiKontrak = $sp->nilai_kontrak2;
                    }
                }

                // Calculate total operational from SPJ (with safe defaults)
                // Prioritize user-submitted values from hidden inputs if available
                $nilaiKontrak_to_use = $rekapData['nilai_kontrak_hidden'] ?? $nilaiKontrak;
                $bbm_to_use = $rekapData['bbm_hidden'] ?? ($spj->totalisibbm ?? 0);
                $uang_makan_to_use = $rekapData['uang_makan_hidden'] ?? ($spj->uangmakan ?? 0);
                $parkir_to_use = $rekapData['parkir_hidden'] ?? ($spj->uanglainlain ?? 0);
                $totalOperasional = ($spj->totalisibbm ?? 0) + ($spj->uangmakan ?? 0) + ($spj->PenggunaanToll ?? 0) + ($spj->uanglainlain ?? 0);
                if (isset($rekapData['premium_percentage']) && $rekapData['premium_percentage'] !== '') {
                    if ($rekapData['premium_percentage'] === 'custom' && !empty($rekapData['custom_premium'])) {
                        $premiPercentage = (int)$rekapData['custom_premium'];
                    } else {
                        $premiPercentage = (int)$rekapData['premium_percentage'];
                    }
                } else {
                    if ($sj->driver2 != null && ($sj->driver2 === $crewName || $sj->driver === $crewName)) {
                        $premiPercentage = 10;
                    } else {
                        $premiPercentage = $this->calculatePremiPercentage($seri, $posisi);
                    }
                }

                // Car wash cost based on seri (same logic as generate)
                $cuci = 0;
                if ($seri == 1) {
                    $cuci = 5000;
                } elseif ($seri == 2) {
                    $cuci = 5000;
                } elseif ($seri == 3) {
                    $cuci = 7500;
                }

                // Prioritize user-submitted cuci value, otherwise use calculated cuci
                $cuci_to_use = $rekapData['cuci_hidden'] ?? $cuci;
                $toll_to_use = $rekapData['toll_hidden'] ?? ($spj->PenggunaanToll ?? 0);
                $subsidi_to_use = $rekapData['subsidi_hidden'] ?? null;

                $totalOperasional = $bbm_to_use + $uang_makan_to_use + $parkir_to_use + $toll_to_use;
                $sisaNilaiKontrak = $nilaiKontrak_to_use - $totalOperasional;

                $basePremi = ($sisaNilaiKontrak * $premiPercentage) / 100;

                $premi = max(0, ($sisaNilaiKontrak * $premiPercentage / 100) - $cuci_to_use);

                // Subsidy from form (match generate(): default to null)
                $totalGaji = $premi + ($subsidi_to_use ?? 0);

                // Use submitted hari_kerja, or recompute if SP dates are available, otherwise use existing
                $hariKerja_to_use = $rekapData['hari_kerja'] ?? ($sp ? $this->countWorkDays($sp->tgl_keberangkatan, $sp->tgl_kepulangan) : $rekapGaji->hari_kerja);

                // Update model with computed values and keep any editable fields from the form
                $rekapGaji->update([
                    'tanggal' => $rekapData['tanggal'],
                    'hari_kerja' => $hariKerja_to_use,
                    'nama_pemesanan' => $rekapData['nama_pemesanan'],
                    'nilai_kontrak' => $nilaiKontrak_to_use,
                    'bbm' => $bbm_to_use,
                    'uang_makan' => $uang_makan_to_use,
                    'parkir' => $parkir_to_use,
                    'cuci' => $cuci_to_use,
                    'toll' => $toll_to_use,
                    'subsidi' => $subsidi_to_use,
                    'total_gaji' => $totalGaji,
                    'total_operasional' => $totalOperasional,
                    'sisa_nilai_kontrak' => $sisaNilaiKontrak,
                    // store 'premi' as base premium (before cuci deduction) to match generate()
                    'premi' => $basePremi,
                    'presentase_premi' => $premiPercentage,
                ]);

                $computed = true;
            }
        }

        // If we couldn't compute using SP/SJ, fallback to previous behavior using submitted hidden values
        if (!$computed) {
            $bbm_val = $rekapData['bbm_hidden'] ?? $rekapGaji->bbm;
            $uang_makan_val = $rekapData['uang_makan_hidden'] ?? $rekapGaji->uang_makan;
            $cuci_val = (int)($rekapData['cuci_hidden'] ?? $rekapGaji->cuci ?? 0);
                                ($rekapData['toll_hidden'] ?? 0) +
                                ($rekapData['parkir_hidden'] ?? 0);

            $nilaiKontrak = $rekapData['nilai_kontrak_hidden'] ?? $rekapGaji->nilai_kontrak;
            $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional;

            $premiPercentage = ($rekapData['premium_percentage'] === 'custom' && !empty($rekapData['custom_premium']))
                ? (int)$rekapData['custom_premium'] 
                : (int)($rekapData['premium_percentage'] ?? $rekapGaji->presentase_premi ?? 0);

            $totalOperasional = $bbm_val + $uang_makan_val + ($rekapData['toll_hidden'] ?? $rekapGaji->toll ?? 0) + ($rekapData['parkir_hidden'] ?? $rekapGaji->parkir ?? 0);
            $sisaNilaiKontrak = $nilaiKontrak - $totalOperasional;

            $basePremi = ($sisaNilaiKontrak * $premiPercentage) / 100;
            $premi = max(0, $basePremi - $cuci_val);
            // Subsidy from form (match generate(): default to null)
            $subsidi = array_key_exists('subsidi_hidden', $rekapData) ? $rekapData['subsidi_hidden'] : null;
            $totalGaji = $premi + ($subsidi ?? 0);

            $rekapGaji->update([
                'tanggal' => $rekapData['tanggal'],
                'hari_kerja' => $rekapData['hari_kerja'],
                'nama_pemesanan' => $rekapData['nama_pemesanan'],
                'nilai_kontrak' => $nilaiKontrak, // This already uses $rekapData['nilai_kontrak_hidden']
                'bbm' => $bbm_val,
                'uang_makan' => $uang_makan_val,
                'parkir' => $rekapData['parkir_hidden'] ?? $rekapGaji->parkir, // Use submitted, else existing
                'cuci' => $cuci_val,
                'toll' => $rekapData['toll_hidden'] ?? $rekapGaji->toll,
                'subsidi' => $subsidi,
                'total_gaji' => $totalGaji,
                'total_operasional' => $totalOperasional,
                'sisa_nilai_kontrak' => $sisaNilaiKontrak,
                // store premi as base premium to match generate()
                'premi' => $basePremi,
                'presentase_premi' => $premiPercentage
            ]);
        }
    }

    // Redirect back with a success message
    return redirect()->route('manajemen_armada.rekap_gaji', ['id_armada' => $request->id_armada])
                     ->with('success', 'Rekap Gaji Crew successfully updated.');
}
}
