<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $dosen = Dosen::where('id', $mahasiswa->dosenpa_id)->first();

        return view('mahasiswa.profile.profile', compact('user', 'mahasiswa', 'dosen'));
    }

    public function showDosen()
    {
        $user = auth()->user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        return view('dosen.profile.show', compact('user', 'dosen'));
    }

    public function showAdmin()
    {
        $user = auth()->user();
        // $dosen = Dosen::where('user_id', $user->id)->first();

        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $dosen = Dosen::where('id', $mahasiswa->dosenpa_id)->first();


        return view('mahasiswa.profile.editprofile', compact('user', 'mahasiswa', 'dosen'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'peminatan' => 'required|string|max:255',
        ]);
    
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            $mahasiswa->update([
                'peminatan' => $request->peminatan,
            ]);
        }   
      

        // Redirect back with a success message
        return redirect()->route('profile.mahasiswa')->with('success', 'Peminatan berhasil disimpan');
    }

    public function editPassword()
    {
       return view('editpassword');
    }



    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|different:current_password',
        ]);

    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
            ->with('error', 'Password baru tidak boleh sama dengan password lama');
        }
        
        // Verify the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama salah');
        }
    
        // Update the password using the update method
        $user->update([
            'password' => Hash::make($request->new_password),
            // 'raw_password' => $request->new_password,
        ]);

        // Redirect back with a success message
        if($user->role === 'mahasiswa'){
            return redirect()->route('profile.mahasiswa')->with('success', 'Password berhasil diubah');
        } elseif($user->role === 'dosen'){
            return redirect()->route('profile.dosen')->with('success', 'Password berhasil diubah');
        } else{
            return redirect()->route('profile.admin')->with('success', 'Password berhasil diubah');
        }
        
    }
    
    
}
