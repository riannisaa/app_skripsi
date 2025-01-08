<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\TopikModel;
use App\Models\DospemModel;
use Illuminate\Http\Request;
use App\Models\RekomendasiModel;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAdmin()
    {
        return view('auth.login-admin');
    }

    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            // $user = Auth::user();
            // $role = $user->role; // Assuming you have a 'role' attribute in your user model
    
            // // Redirect based on the user's role
            // if ($role === 'admin' || $role === 'dekanat' ) {
            //     return redirect()->route('dashboard.admin');
            // } elseif ($role === 'kaprodi') {
            //     return redirect()->route('dashboard.kaprodi');
            // } 
            // else {
            //     return back();
            // }
            return redirect()->intended($this->redirectToRole(Auth::user()->role));
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan tidak sesuai',
        ])->onlyInput('email');

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim_nip' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            // $user = Auth::user();
            // $role = $user->role; // Assuming you have a 'role' attribute in your user model
    
            // // Redirect based on the user's role
            // if ($role === 'mahasiswa') {
            //     return redirect()->route('dashboard.mahasiswa');
            // } elseif ($role === 'dosen') {
            //     return redirect()->route('dashboard.dosen');
            // } else {
            //     return back();
            // }  
            return redirect()->intended($this->redirectToRole(Auth::user()->role));
         

        }

        return back()->withErrors([
            'nim_nip' => 'NIM/NIP atau Password yang Anda masukkan tidak sesuai',
        ])->onlyInput('nim_nip');

    } 

    private function redirectToRole($role)
    {
        switch ($role) {
            case 'mahasiswa':
                return route('dashboard.mahasiswa');
            case 'dosen':
                return route('dashboard.dosen');
            case 'admin':
                return route('dashboard.admin');
            case 'kaprodi':
                return route('dashboard.kaprodi');
            case 'dekanat':
                return route('dashboard.admin');        
            default:
                return back();
        }

             // if ($role === 'admin' || $role === 'dekanat' ) {
            //     return redirect()->route('dashboard.admin');
            // } elseif ($role === 'kaprodi') {
            //     return redirect()->route('dashboard.kaprodi');
            // } 
    }
     
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }   


    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginAdmin')
            ->withSuccess('You have logged out successfully!');;
    } 
    
}
