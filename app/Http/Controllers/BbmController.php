<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Armada;
use App\Models\Unit;
use App\Models\Konsumbbm;
use App\Models\Spj;
use App\Models\Sj;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class BbmController extends Controller
{
    public function index($id_spj)
    {
        // Fetch the Konsumbbm data based on id_spj
        $bbms = KonsumBbm::where('id_spj', $id_spj)->get();
        
        // Fetch the corresponding SPJ record
        $spj = Spj::where('id_spj', $id_spj)->first();

        $sj = SJ::where('id_sj', $spj->id_sj)->first();
        $id_sp = $sj->id_sp;


        return view('bbm.index', compact('bbms', 'spj', 'id_sp'));
    }

    
    
    public function create(Request $request, $id_spj)
    {
        $validatedData = $request->validate([
            'isiBBM' => 'required|numeric',
            'tanggal' => 'required|date',
            'lokasiisi' => 'required|string',
            'totalbayar' => 'required|numeric',
            'foto_struk' => 'nullable|image',
            'isvalid' => 'required|boolean',
        ]);

        $validatedData['id_spj'] = $id_spj;

        if ($request->hasFile('foto_struk')) {
            $validatedData['foto_struk'] = $request->file('foto_struk')->store('public/bbm');
        }

        Konsumbbm::create($validatedData);
        return redirect()->route('bbm.index', ['id_spj' => $id_spj])->with('success', 'Data created successfully.');
    }
    
    public function edit($idkonsumbbm)
    {
        // Log incoming data for debugging
        Log::info('Edit BBM Request', [
            'files' => request()->allFiles(),
            'input' => request()->all()
        ]);
    
        $bbm = Konsumbbm::findOrFail($idkonsumbbm);
    
        $validatedData = request()->validate([
            'isiBBM' => 'nullable|numeric',
            'tanggal' => 'nullable|date',
            'lokasiisi' => 'nullable|string',
            'totalbayar' => 'nullable|numeric',
            'foto_struk' => 'nullable|image|max:2048', // Added max file size
            'isvalid' => 'nullable|boolean',
        ]);
    
        if (request()->hasFile('foto_struk')) {
            // Log file details
            Log::info('Foto Struk uploaded', [
                'filename' => request()->file('foto_struk')->getClientOriginalName(),
                'size' => request()->file('foto_struk')->getSize()
            ]);
    
            // Delete old file if exists
            if ($bbm->foto_struk) {
                Storage::delete($bbm->foto_struk);
            }
    
            $validatedData['foto_struk'] = request()->file('foto_struk')->store('public/bbm');
        }
    
        $bbm->update($validatedData);
    
        return back()->with('success', 'BBM data updated successfully.');
    }
    
    
    
    // Di BbmController, tambahkan method untuk mengambil data BBM
public function getEditData($idkonsumbbm) 
{
    $bbm = KonsumBbm::findOrFail($idkonsumbbm);
    return response()->json($bbm);
}
    
    public function destroy($id)
    {
        // Find the Konsumbbm data based on the id
        $bbm = KonsumBbm::findOrFail($id);

        // Delete the Konsumbbm data
        $bbm->delete();

        // Redirect back to the previous page
        return back()->with('success', 'BBM data deleted successfully.');
    }
}