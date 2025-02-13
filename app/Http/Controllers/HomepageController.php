<?php

namespace App\Http\Controllers;
use App\Models\Sp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomepageController extends Controller
{

    public function index()
{
    $sps = DB::table('sp')
        ->join('sj', 'sp.id_sp', '=', 'sj.id_sp')
        ->join('Unit', 'sj.id_unit', '=', 'Unit.id_unit') // Join dengan tabel Unit
        ->select(
            'sp.tgl_keberangkatan', 
            'sp.tgl_kepulangan', 
            'sp.jam_keberangkatan', 
            'sp.jam_kepulangan', 
            'Unit.nama_unit' // Pilih nama_unit dari tabel Unit
        )
        ->get();

    $events = [];

    foreach ($sps as $sp) {
        $events[] = [
            'start' => $sp->tgl_keberangkatan . ' ' . $sp->jam_keberangkatan,
            'end' => $sp->tgl_kepulangan . ' ' . $sp->jam_kepulangan,
            'title' => $sp->nama_unit, // Gunakan nama_unit sebagai title
            'color' => '#8BC34A',
        ];
    }

    return response()->json($events);
}

}