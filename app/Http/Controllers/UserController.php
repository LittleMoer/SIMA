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
<<<<<<< HEAD
>>>>>>> parent of bbf575d (manajemen akun)
=======
>>>>>>> parent of bbf575d (manajemen akun)
}
