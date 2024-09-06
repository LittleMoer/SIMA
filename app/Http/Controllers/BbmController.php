<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Armada;
use App\Models\Unit;
use App\Models\Konsumbbm;
use App\Models\Spj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BbmController extends Controller
{
    public function index($id_spj)
    {
        // Fetch the Konsumbbm data based on id_spj
        $bbms = Konsumbbm::where('id_spj', $id_spj)->get();
        
        // Fetch the corresponding SPJ record
        $spj = Spj::where('id_spj', $id_spj)->first();
        
    
        // Return the view with the BBM and SPJ data
        return view('bbm.index', compact('bbms', 'spj'));
    }
    
    public function create($id_spj)
    {
            KonsumBbm::create([
                'idkonsumbbm' => Konsumbbm::count() + 1,
                'id_spj' => $id_spj,
                'isiBBM' => null,
                'tanggal' => null,
                'lokasiisi' => null,
                'totalbayar' => null,
                'foto_struk' => null,
                'isvalid' => 0
            ]);
    
            return redirect()->route('bbm.index', ['id_spj' => $id_spj])
                             ->with('success', 'Data Konsumsi BBM baru berhasil dibuat.');
    }
    
    public function edit($idkonsumbbm)
    {
        $bbm = Konsumbbm::findOrFail($idkonsumbbm);

        $validatedData = request()->validate([
            'isiBBM' => 'required|numeric',
            'tanggal' => 'required|date',
            'lokasiisi' => 'required|string',
            'totalbayar' => 'required|numeric',
            'foto_struk' => 'nullable|image',
            'isvalid' => 'required|boolean',
        ]);


        if (request()->hasFile('foto_struk')) {
            $validatedData['foto_struk'] = request()->file('foto_struk')->store('public/bbm');
        } else {
            unset($validatedData['foto_struk']);
        }

        $bbm->update($validatedData);

        return back()->with('success', 'BBM data updated successfully.');
    }
    
    
    public function destroy($id)
    {
        // Find the Konsumbbm data based on the id
        $bbm = Konsumbbm::findOrFail($id);

        // Delete the Konsumbbm data
        $bbm->delete();

        // Redirect back to the previous page
        return back()->with('success', 'BBM data deleted successfully.');
    }
}