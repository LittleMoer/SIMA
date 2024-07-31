<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SP;
use App\Models\SPJ;
use App\Models\SJ;

class OrderController extends Controller
{
    public function create()
    {
        return view('create_order');
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_pemesan' => 'required|string|max:50',
            'pj_rombongan' => 'required|string|max:50',
            'no_telppn' => 'required|string|max:12',
            'no_telpps' => 'required|string|max:12',
            'tgl_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
            'tgl_kepulangan' => 'required|date',
            'jam_kepulangan' => 'required|date_format:H:i',
            'tujuan' => 'required|string|max:20',
            'alamat_penjemputan' => 'required|string|max:100',
            'jumlah_armada' => 'required|integer',
            'nilai_kontrak' => 'required|integer',
            'biaya_tambahan' => 'nullable|integer',
            'total_biaya' => 'required|integer',
            'uang_muka' => 'required|integer',
            'sisa_pembayaran' => 'nullable|integer',
            'catatan_pembayaran' => 'nullable|string'
        ]);

        // Simpan data order ke database
        $orderData = $request->except('_token');
        $order = SP::create($orderData);

        // Generate SPJ
        $spj = SPJ::create([
            'nolambung' => 'Nolambung Auto',
            'SaldoEtollawal' => 0,
            'SaldoEtollakhir' => 0,
            'PenggunaanToll' => 0,
            'uanglainlain' => 0,
            'uangmakan' => 0,
            'idkonsumbbm' => null,
            'sisabbm' => 0,
            'totalisibbm' => 0,
            'sisasaku' => 0,
            'totalsisa' => 0
        ]);

        // Generate SJ
        $sj = SJ::create([
            'seri_armada' => 'Seri Armada Auto',
            'nilai_kontrak' => $request->nilai_kontrak,
            'kmsebelum' => '0',
            'kmtiba' => '0',
            'kasbonbbm' => '0',
            'kasbonmakan' => '0',
            'lainlain' => '0'
        ]);

        // Update order dengan id_spj dan id_sj
        $order->update([
            'id_spj' => $spj->id_spj,
            'id_sj' => $sj->id_sj,
        ]);

        return redirect()->route('order.create')->with('success', 'Order created successfully.');
    }
}
