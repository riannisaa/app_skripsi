<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DospemModel;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //
    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $data = Mahasiswa::paginate(25);

        return view('admin.kelolamahasiswa', [
            'data' => $data,
            'search' => $search
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:mahasiswa,id',
            'status' => 'required|in:0,1', // Assuming status can only be 0 or 1
        ]);

        $mahasiswa = Mahasiswa::find($request->id);
        if($request->status == 1) {
            $getDosen = DospemModel::where('mahasiswa_id','=',$request->id)
            ->where('status','=','Sah')
            ->first();
            if(!is_null($getDosen)) {
                if(!is_null($getDosen->dp1_id)) {
                    Dosen::where('id', $getDosen->dp1_id)->decrement('peserta_dp1');
                }
                if(!is_null($getDosen->dp2_id)) {
                    Dosen::where('id', $getDosen->dp2_id)->decrement('peserta_dp2');
                }
                $getDosen->status = "Lulus";
                $getDosen->save();
            }
        }
        $mahasiswa->status_mhs = $request->status;
        $mahasiswa->save();

        return redirect()->route('showMahasiswa')->with('success', 'Status mahasiswa berhasil diperbarui');
    }

    public function searchMahasiswa(Request $request)
    {
        // $user = Auth::user();
        // $role = $user->role;
        $search = $request->input('search');

        if ($search) {
            $results = Mahasiswa::where('nama_mahasiswa', 'like', '%' . $search . '%')
                ->paginate(25);

                return view('admin.kelolamahasiswa', [
                    'data' => $results, 
                    'search' => $search
                ]);    
   
        }
        return redirect()->route('showMahasiswa'); 


    }  
}
