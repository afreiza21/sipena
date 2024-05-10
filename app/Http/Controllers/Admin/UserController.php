<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::all();
        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'min:1'],
            ],
            [
                'name.required' => 'Nama lengkap harus diisi',
                'name.string' => 'Nama lengkap harus diisi',
                'name.max' => 'Nama lengkap maksimal 255 karakter',
                'email.required' => 'Email harus diisi',
                'email.string' => 'Email harus diisi',
                'email.max' => 'Email maksimal 255 karakter',
                'email.unique' => 'Email sudah digunakan',
                'email.email' => 'Harus dalam format email',
                'password.required' => 'Password harus diisi',    
                'password.string' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password tidak sama',     
                'role.required' => 'Role harus diisi',       
                'role.min' => 'Role harus diisi',       
            ]            
        );
        
        User::create([
            'name' => $request->name,
            'email'  => $request->email,
            'role' => $request->role,        
            'password'  => Hash::make($request->password),                
        ]);        

        return redirect()->route('admin.user')->with('success', 'User '.$request->name.' telah ditambahkan');
    }

    public function destroy($id)
    {
        
        $data = User::find($id);            
        $data->delete();
    
        return redirect()->route('admin.user')->with('success', 'User telah dihapus');
    }

    public function reset($id)
    {
        
        $data = User::find($id);            
        $data->delete();
    
        return redirect()->route('admin.user')->with('success', 'User telah dihapus');
    }

}
