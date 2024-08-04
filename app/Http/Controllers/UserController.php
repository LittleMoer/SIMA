<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Akun::all();
        return view('manajemen_akun', compact('users'));
    }

    public function update(Request $request, $username)
    {
        // Cari user berdasarkan username
        $user = Akun::where('username', $username)->firstOrFail();
    
        // Validasi dinamis
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                function ($attribute, $value, $fail) use ($user) {
                    // Validasi untuk domain gmail.com
                    if (!str_ends_with($value, '@gmail.com')) {
                        $fail('The email must be a Gmail address.');
                    }
    
                    // Validasi untuk email yang sudah ada
                    if ($value !== $user->email) {
                        $exists = Akun::where('email', $value)
                                       ->where('id_akun', '!=', $user->id_akun)
                                       ->exists();
                        if ($exists) {
                            $fail('The email has already been taken.');
                        }
                    }
                }
            ],
            'role_id' => 'sometimes|required|integer',
        ]);
    
        // Hanya mengisi field yang ada dalam permintaan
        if ($request->has('email') && $request->input('email') === $user->email) {
            // Jika email tidak diubah, hapus dari data yang akan diupdate
            unset($validatedData['email']);
        }
    
        $user->fill($validatedData);
    
        // Tambahkan log untuk debug
        Log::info('User data before save:', $user->toArray());
    
        // Simpan perubahan
        $user->save();
    
        Log::info('User updated successfully.');
    
        return back()->with('success', 'User updated successfully.');
    }
    
    public function destroy($username)
    {
        $akun = Akun::where('username', $username)->firstOrFail();
        $akun->delete();
    
        return redirect()->route('manajemen_akun');
    }
}
