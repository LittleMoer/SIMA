<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;




class UserController extends Controller
{
    public function update(Request $request, $username)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $akuns = Akun::all();
        return view('manajemen_akun', compact('akuns'));
    }
    public function update(Request $request, $username)
    {
        $akun = Akun::where('username', $username)->firstOrFail();
    
        $emailRules = 'required|string|email|max:255';
        if ($request->email !== $akun->email) {
            $emailRules .= '|unique:akun';
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => $emailRules,
            'role_id' => 'required|exists:roles,roleid',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $akun->name = $request->name;
        $akun->email = $request->email;
        $akun->role_id = $request->role_id;
        $akun->save();
    
        // session()->flash('success', 'User berhasil diupdate.'); 
        
        return redirect()->route('manajemen_akun');
    }
    
    
    
    public function destroy($username)
    {
        $akun = Akun::where('username', $username)->firstOrFail();
        $akun->delete();
    
        return redirect()->route('manajemen_akun');
    }
    


=======
=======
>>>>>>> parent of bbf575d (manajemen akun)
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role_id' => 'required|integer',
        ]);

        // Find the user by username
        $user = Akun::where('username', $username)->firstOrFail();

        // Update the user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User updated successfully');
    }
    public function index() {
        $users = Akun::all();
        return view('manajemen_akun', compact('users'));
    }
<<<<<<< Updated upstream
<<<<<<< HEAD
>>>>>>> parent of bbf575d (manajemen akun)
=======
>>>>>>> parent of bbf575d (manajemen akun)
=======

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
>>>>>>> Stashed changes
}
