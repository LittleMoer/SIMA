<?php

namespace App\Http\Controllers;
use App\Models\Konsumbbm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Sp;
use Illuminate\Support\Facades\Auth;
use App\Models\Spj;
use App\Models\Sj;
use App\Models\Unit;
use App\Models\UnitAvailability;
use Carbon\Carbon;
use App\Models\Armada;
use App\Models\PengeluaranUangSaku;

class CrewController extends Controller
{
    public function index()
    {
        return view('crew.dashboard');
    }

    public function pesanan()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
    
        // Cari data SJ berdasarkan driver atau codriver
        $sj = Sj::where('driver', $user->name)
            ->orWhere('codriver', $user->name)
            ->get();
    
        // Ambil semua id_sp dari SJ
        $id_sp = $sj->pluck('id_sp')->toArray();
    
        // Ambil data SP beserta relasi SJ dan SPJ, hanya tampilkan data ke setelah bulan tersebut,setelah 4 hari pada setiap awal bulan sembunyikan semua data sebelum bulan tersebut,gunakan tgl_keberangkatan sebagai acuan
        $sp = Sp::whereIn('id_sp', $id_sp)
            ->where('tgl_keberangkatan', '>=', Carbon::now()->subDays(4)->startOfMonth())
            ->with(['sj.spj']) // Load relasi SJ dan SPJ
            ->get();
        // $sp = SP::whereIn('id_sp', $id_sp)
        //     ->with(['sj.spj']) // Load relasi SJ dan SPJ
        //     ->get();
        return view('crew.pesanan', compact('sp')); // Kirim data ke view
    }

    public function detail($id)
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Ambil data SP berdasarkan id_sp
        $sp = SP::where('id_sp', $id)->firstOrFail();

        // Ambil semua SJ terkait SP yang sesuai dengan driver atau codriver
        $sjs = SJ::where('id_sp', $id)
            ->where(function ($query) use ($user) {
                $query->where('driver', $user->name)->orWhere('codriver', $user->name);
            })
            ->get();

        // Ambil semua SPJ terkait dengan SJ yang ditemukan
        $spjs = SPJ::whereIn('id_sj', $sjs->pluck('id_sj'))->get();

        // Ambil data Unit yang relevan (jika dibutuhkan)
        $units = Unit::orderBy('seri_unit')->get();

        return view('crew.detail_pesanan', compact('sp', 'sjs', 'spjs', 'units'));
    }

    // BBM
    public function bbmindex($id_spj)
    {
        // Fetch the Konsumbbm data based on id_spj
        $bbms = KonsumBbm::where('id_spj', $id_spj)->get();

        // Fetch the corresponding SPJ record
        $spj = Spj::where('id_spj', $id_spj)->first();

        $sj = SJ::where('id_sj', $spj->id_sj)->first();
        $id_sp = $sj->id_sp;

        return view('crew.bbm', compact('bbms', 'spj', 'id_sp'));
    }

    public function bbmcreate(Request $request, $id_spj)
    {
        $validatedData = $request->validate([
            'isiBBM' => 'required|numeric',
            'tanggal' => 'required|date',
            'lokasiisi' => 'required|string',
            'totalbayar' => 'required|numeric',
            'foto_struk' => 'nullable|image',
            'isvalid' => 'nullable|boolean',
        ]);

        $validatedData['id_spj'] = $id_spj;

        if ($request->hasFile('foto_struk')) {
            $validatedData['foto_struk'] = $request->file('foto_struk')->store('public/bbm');
        }

        Konsumbbm::create($validatedData);
        return redirect()->route('crew.bbm', ['id_spj' => $id_spj])->with('success', 'Data created successfully.');
    }
    public function bbmedit($idkonsumbbm)
    {
        $bbm = Konsumbbm::findOrFail($idkonsumbbm);

        $validatedData = request()->validate([
            'isiBBM' => 'required|numeric',
            'tanggal' => 'required|date',
            'lokasiisi' => 'required|string',
            'totalbayar' => 'required|numeric',
            'foto_struk' => 'nullable|image',
        ]);

        if (request()->hasFile('foto_struk')) {
            $validatedData['foto_struk'] = request()->file('foto_struk')->store('public/bbm');
        } else {
            unset($validatedData['foto_struk']);
        }

        $bbm->update($validatedData);

        return back()->with('success', 'BBM data updated successfully.');
    }

    public function bbmgetEditData($idkonsumbbm)
    {
        $bbm = KonsumBbm::findOrFail($idkonsumbbm);
        return response()->json($bbm);
    }

    public function bbmdestroy($id)
    {
        // Find the Konsumbbm data based on the id
        $bbm = KonsumBbm::findOrFail($id);

        // Delete the Konsumbbm data
        $bbm->delete();

        // Redirect back to the previous page
        return back()->with('success', 'BBM data deleted successfully.');
    }

    public function updateSPJ(Request $request, $id)
{
    // Temukan SPJ yang akan diupdate
    $spj = SPJ::findOrFail($id);
    $sj = SJ::findOrFail($spj->id_sj);

    // Validate all inputs
    $request->validate([
        'SaldoEtollawal' => 'nullable',
        'SaldoEtollakhir' => 'nullable',
        'PenggunaanToll' => 'nullable',
        'totalisibbm'  => 'nullable',
        'sisasaku'  => 'nullable',
        'totalsisa'  => 'nullable',
        'uanglainlain' => 'nullable',
        'uangmakan' => 'nullable',
        'kmsebelum' => 'nullable',
        'kmtiba' => 'nullable',
        'kmtempuh' => 'nullable',
    ]);

    // Update SPJ
    $spj->update([
        'SaldoEtollawal' => $request->SaldoEtollawal,
        'SaldoEtollakhir' => $request->SaldoEtollakhir,
        'PenggunaanToll' => $request->PenggunaanToll,
        'totalisibbm'  => $request-> totalisibbm,
        'sisabbm'  => $request-> sisabbm,
        'sisasaku'  => $request-> sisasaku,
        'totalsisa'  => $request->totalsisa,
        'uanglainlain' => $request->uanglainlain,
        'uangmakan' => $request->uangmakan,
    ]);

    // Update SJ
    $sj->update([
        'kmsebelum' => $request->kmsebelum,
        'kmtiba' => $request->kmtiba,
        'kmtempuh' => $request->kmtempuh,
    ]);

    return redirect()
        ->route('crew.detail_pesanan', ['id' => $sj->id_sp])
        ->with('success', 'SPJ berhasil diupdate!');
}

    // Menampilkan daftar pengeluaran uang saku berdasarkan id_spj
    public function pengeluaranindex($id_spj)
    {
        $spj = Spj::where('id_spj', $id_spj)->first();
        $sj = SJ::where('id_sj', $spj->id_sj)->first();
        $id_sp = $sj->id_sp;
        $pengeluaran = PengeluaranUangSaku::where('id_spj', $id_spj)->get();
        return view('crew.pengeluaran', compact('spj', 'id_sp', 'sj', 'pengeluaran'));
    }

    // Menambahkan pengeluaran uang saku baru
    public function pengeluaranstore(Request $request, $id_spj)
    {
        $validatedData = $request->validate([
            'nominal' => 'nullable|numeric',
            'catatan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $validatedData['id_spj'] = $id_spj;
        PengeluaranUangSaku::create($validatedData);

        return redirect()->route('crew.pengeluaran', $id_spj)->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    // Menampilkan form untuk edit pengeluaran
    public function pengeluaranedit($id_pengeluaran)
    {
        $pengeluaran = PengeluaranUangSaku::findOrFail($id_pengeluaran);
        return response()->json($pengeluaran);
    }

    // Memperbarui data pengeluaran uang saku
    public function pengeluaranupdate(Request $request, $id_pengeluaran)
    {
        $pengeluaran = PengeluaranUangSaku::findOrFail($id_pengeluaran);

        $validatedData = $request->validate([
            'nominal' => 'required|numeric',
            'catatan' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        $pengeluaran->update($validatedData);

        return redirect()
            ->route('crew.pengeluaran', $pengeluaran->id_spj)
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    // Menghapus pengeluaran uang saku
    public function pengeluarandestroy($id_pengeluaran)
    {
        $pengeluaran = PengeluaranUangSaku::findOrFail($id_pengeluaran);
        $pengeluaran->delete();

        return back()->with('success', 'Pengeluaran berhasil dihapus.');
    }



    // calendar
    public function showCalendar(Request $request) {
        // Ambil bulan dan tahun saat ini
        $currentMonth = $request->input('month', now()->month); 
        $currentYear = $request->input('year', now()->year);
    
        // Ambil data user yang sedang login
        $user = Auth::user(); 
    
        // Ambil semua unit dan urutkan berdasarkan seri_unit 
        $units = Unit::orderBy('seri_unit')->get(); 
        $availability = []; // Data ketersediaan per unit
    
        foreach ($units as $unit) {
            // Ambil pemesanan untuk unit tertentu dalam bulan yang dipilih, urutkan berdasarkan tgl_keberangkatan
            $bookings = Sp::whereHas('sj', function ($query) use ($unit) {
                $query->where('id_unit', $unit->id_unit);
            })
            ->whereMonth('tgl_keberangkatan', $currentMonth)
            ->whereYear('tgl_keberangkatan', $currentYear)
            ->with(['sj' => function ($query) {
                $query->select('id_sp', 'driver', 'codriver');
            }])
            ->orderBy('tgl_keberangkatan')
            ->get();
    
            // Siapkan data ketersediaan yang hanya sesuai dengan driver atau codriver yang sedang login
            foreach ($bookings as $booking) {
                foreach ($booking->sj as $sj) {
                    // Cek apakah pengguna yang sedang login adalah driver atau codriver pada jadwal ini
                    if ($sj->driver == $user->name || $sj->codriver == $user->name) {
                        $keberangkatan = Carbon::parse($booking->tgl_keberangkatan);
                        $kepulangan = Carbon::parse($booking->tgl_kepulangan);
    
                        // Simpan data ke dalam availability
                        $availability[$unit->id_unit][] = [
                            'range' => $keberangkatan->format('d') . '-' . $kepulangan->format('d'),
                            'nama_pemesan' => $booking->nama_pemesan,
                            'driver' => $sj->driver,
                            'codriver' => $sj->codriver,
                            'tgl_keberangkatan' => $booking->tgl_keberangkatan,
                        ];
                    }
                }
            }
        }
    
        return view('crew.events', compact('units', 'currentYear', 'currentMonth', 'availability'));
    }
    
    public function showMonthlyCalendar(Request $request)
    {
        // Ambil bulan dan tahun dari request, defaultnya bulan dan tahun sekarang
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Dapatkan jumlah hari dalam bulan tersebut
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
        
        // Dapatkan daftar unit
        $units = Unit::all()->sortBy('seri_unit');

        // Ambil data ketersediaan dari database untuk bulan tersebut
        $availability = UnitAvailability::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->groupBy('date');

        return view('crew.calendar', compact('daysInMonth', 'month', 'year', 'units', 'availability'));
    }
}
