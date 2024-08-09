<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $akuns = Akun::all();
        return view('manajemen_akun', compact('akuns'));
    }
    public function update(Request $request, $username)
    {
        // Validasi input
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:akun,email,' . $username . ',username',
            'role_id' => 'required|integer'
        ]);

        // Temukan akun berdasarkan username
        $akun = Akun::where('username', $username)->firstOrFail();

        // Update data akun
        $akun->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('manajemen_akun')->with('success', 'Akun berhasil diperbarui.');
    }
    
    
    
    public function destroy($username)
    {
        $akun = Akun::where('username', $username)->firstOrFail();
        $akun->delete();
    
        return redirect()->route('manajemen_akun');
    }
    


}
