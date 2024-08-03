<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('manajemen_akun', compact('users'));
    }
    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
    
        $emailRules = 'required|string|email|max:255';
        if ($request->email !== $user->email) {
            $emailRules .= '|unique:users';
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => $emailRules,
            'role_id' => 'required|exists:roles,roleid',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();
    
        session()->flash('success', 'User berhasil diupdate.'); 
        
        return redirect()->route('manajemen_akun');
    }
    
    
    
    public function destroy($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();
    
        return redirect()->route('manajemen_akun');
    }
    

}
