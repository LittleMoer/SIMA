<?php

namespace App\Http\Controllers;
use App\Models\KonsumBbm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SP;
use Illuminate\Support\Facades\Auth;
use App\Models\SPJ;
use App\Models\UnitAvailability;
use App\Models\SJ;
use App\Models\Unit;
use Carbon\Carbon;

use App\Models\Armada;
use App\Models\PengeluaranUangSaku;

class ViewerController extends Controller
{
    public function index()
    {
        return view('viewer.dashboard');
    }

    public function pesanan(){
        $sp = SP::all(); 
        return view('viewer.pesanan', compact('sp')); 
    }
    

    public function detail($id)
    {
        // Retrieve the SP record based on id_sp
        $sp = SP::where('id_sp', $id)->firstOrFail();

        // Retrieve all SJ records related to this SP
        $sjs = SJ::where('id_sp', $id)->get();

        // Retrieve all SPJ records related to this SP
        //   $spjs = SPJ::where('id_sj', $id)->get();

        // Retrieve all SPJ records where id_sj is among the SJ records retrieved
        $spjs = SPJ::whereIn('id_sj', $sjs->pluck('id_sj'))->get();

        $units = Unit::all();
        // Pass data to the view
        $units = Unit::orderBy('seri_unit')->get();

        return view('viewer.detail_pesanan', compact('sp', 'sjs', 'spjs', 'units'));
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

        return view('viewer.calendar', compact('daysInMonth', 'month', 'year', 'units', 'availability'));
    }

}
