<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    
    public function home()
    {
        $properties = Properties::orderBy('created_at', 'desc')->paginate(20);
        // dd($properties);
        return view('home', compact('properties')); // Kirim ke view
    }
    
    
    public function list()
    {
        $properties = Properties::orderBy('created_at', 'desc')->paginate(20);
        // dd($properties);
        return view('list', compact('properties')); // Kirim ke view
    }
    

    public function index()
    {
        $properties = Properties::all(); // Ambil semua data
        // dd($properties);
        return view('index', compact('properties')); // Kirim ke view
    }


    public function show($id)
    {
        $property = Properties::findOrFail($id);
        return view('detail', compact('property'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string',
            'lt' => 'nullable|integer',
            'lb' => 'nullable|integer',
            'km' => 'nullable|integer',
            'kt' => 'nullable|integer',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric',
            'no_hp' => 'required|string',
            'whatsapp' => 'nullable|string',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah agar mendukung multiple images
        ]);
    
        $gambarPaths = [];
    
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('gambar', 'public');
                $gambarPaths[] = $path;
            }
        }
    
        $validated['gambar'] = json_encode($gambarPaths); // Simpan sebagai JSON di database
    
        Properties::create($validated);
    
        return redirect()->route('properties.index')->with('success', 'Properti berhasil ditambahkan!');
    }    

    public function edit(Properties $Properties)
    {
        return view('properties.edit', compact('Properties'));
    }

    public function update(Request $request, $id)
    {
        $property = Properties::findOrFail($id);
    
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'lt' => 'nullable|numeric',
            'lb' => 'nullable|numeric',
            'km' => 'nullable|integer',
            'kt' => 'nullable|integer',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'no_hp' => 'required|string|max:15',
            'whatsapp' => 'required|string|max:15',
            'gambar' => 'nullable|image|max:2048',
        ]);
    
        $property->update($request->except('gambar'));

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('properties', 'public');
            $property->gambar = $gambarPath;
            $property->save();
        }
    
        return redirect()->back()->with('success', 'Properti berhasil diperbarui!');
    }
    
    public function filter(Request $request)
    {
        $query = Properties::query();

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->input('jenis'));
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%' . $request->input('lokasi') . '%');
        }

        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->input('harga_min'));
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->input('harga_max'));
        }

        $properties = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('filter', compact('properties'));
    }

    public function destroy($id)
{
    $property = Properties::findOrFail($id);
    
    if ($property->gambar) {
        Storage::delete('public/' . $property->gambar);
    }
    
    $property->delete();

    return redirect()->route('properties.index')->with('success', 'Properti berhasil dihapus!');
}
}
