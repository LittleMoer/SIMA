<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SP;
use App\Models\SPJ;
use App\Models\SJ;

class OrderController extends Controller
{
    public function index()
    {
        $sp = SP::all(); 
        return view('pesanan', compact('sp'));  // Mengirimkan data ke view
    }
    
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_pemesan' => 'required|string|max:50',
            'pj_rombongan' => 'required|string|max:50',
            'no_telppn' => 'required|string|max:12',
            'no_telpps' => 'required|string|max:12',
            'tgl_keberangkatan_full' => 'required|date_format:Y-m-d\TH:i',
            'tgl_kepulangan_full' => 'required|date_format:Y-m-d\TH:i',
            'tujuan' => 'required|string|max:20',
            'alamat_penjemputan' => 'required|string|max:100',
            'jumlah_armada' => 'required|integer',
            'nilai_kontrak' => 'required|integer',
            'biaya_tambahan' => 'nullable|integer',
            'total_biaya' => 'required|integer',
            'uang_muka' => 'required|integer',
            'status_pembayaran' => 'required|integer',
            'sisa_pembayaran' => 'nullable|integer',
            'metode_pembayaran' => 'required|string|max:10',
            'catatan_pembayaran' => 'nullable|string'
        ]);

        // Pisahkan tanggal dan waktu keberangkatan
        $tgl_keberangkatan = date('Y-m-d', strtotime($request->tgl_keberangkatan_full));
        $jam_keberangkatan = date('H:i', strtotime($request->tgl_keberangkatan_full));

        // Pisahkan tanggal dan waktu kepulangan
        $tgl_kepulangan = date('Y-m-d', strtotime($request->tgl_kepulangan_full));
        $jam_kepulangan = date('H:i', strtotime($request->tgl_kepulangan_full));

        // Simpan data order ke database
        $orderData = $request->except('_token', 'tgl_keberangkatan_full', 'tgl_kepulangan_full');
        $orderData['tgl_keberangkatan'] = $tgl_keberangkatan;
        $orderData['jam_keberangkatan'] = $jam_keberangkatan;
        $orderData['tgl_kepulangan'] = $tgl_kepulangan;
        $orderData['jam_kepulangan'] = $jam_kepulangan;

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

        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil disimpan');
    }
    public function destroy($id)
    {
        $sp = SP::findOrFail($id);
        $sp->delete();
        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dihapus');
    }
}
