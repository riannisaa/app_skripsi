<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\FormStatus;
use Illuminate\Http\Request;
use App\Models\RekomendasiModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportPengajuanRekomendasi;
use App\Exports\ExportPengajuanRekomendasiDosen;

class RekomendasiController extends Controller
{
    // mahasiswa
    public function show() {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        // belum mengisi peminatan
        if (!isset($mahasiswa->peminatan)) {
            return view('mahasiswa.rekomendasi.show', [
                'messageDataDiri' => 'Anda belum mengisi data peminatan pada halaman Profil Saya'
            ]);
        }
    
        $rekomendasi = RekomendasiModel::where('mahasiswa_id', $mahasiswa->id)->get();
        $isButtonDisabled = false;

        $formStatus = FormStatus::where('form_id', 'rekom')->first();

        if($formStatus->accepting_responses === 0){
            $isButtonDisabled = true;
            return view('mahasiswa.rekomendasi.show', [
                'rekomendasi' => $rekomendasi,
                'message' => 'Form pengajuan rekomendasi akademik telah ditutup',
                'isButtonDisabled' => $isButtonDisabled,

            ]);
        }

        // status pengajuan
        if ($rekomendasi->isNotEmpty()) {
            // Check the status of the last submission
            $lastRekomendasi = $rekomendasi->last();
            if ($lastRekomendasi->status === 'Ditolak') {
                $isButtonDisabled = false;
            } elseif (in_array($lastRekomendasi->status, ['Pending', 'Disetujui'])) {
                $isButtonDisabled = true;
            }
        }
    
        return view('mahasiswa.rekomendasi.show', [
            'rekomendasi' => $rekomendasi,
            'isButtonDisabled' => $isButtonDisabled,
        ]);
    }
    
    // dosen
    public function showAll(Request $request)
    {
        $user = auth()->user();
        $dosen = Dosen::where('user_id', $user->id)->first();
        $dosen_id = $dosen->id;
        $search = $request->input('search');

        $rekomendasi = RekomendasiModel::join('mahasiswa', 'rekomendasi_akademik.mahasiswa_id', '=', 'mahasiswa.id')
        ->select('rekomendasi_akademik.id', 'rekomendasi_akademik.tanggal_pengajuan', 'rekomendasi_akademik.sks', 'rekomendasi_akademik.khs_file', 'rekomendasi_akademik.toefl_file', 'rekomendasi_akademik.ukt_file',
            'rekomendasi_akademik.pkm_file', 'rekomendasi_akademik.seminar_file','rekomendasi_akademik.profesi_file','rekomendasi_akademik.status','rekomendasi_akademik.ket',
            'mahasiswa.nama_mahasiswa', 'mahasiswa.nim', 'mahasiswa.prodi')
            ->where('rekomendasi_akademik.dosenpa_id', $dosen_id)
            ->paginate(25);

        return view('dosen.rekomendasi.show', [
            'rekomendasi' => $rekomendasi,
            'search' => $search

        ]);

    }

    public function searchRekomendasiDosen(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $results = RekomendasiModel::join('mahasiswa', 'rekomendasi_akademik.mahasiswa_id', '=', 'mahasiswa.id')

                ->select(
                    'rekomendasi_akademik.*', 
                    'mahasiswa.*'
                )
                ->where(function ($query) use ($search) {
                    $query->where('nama_mahasiswa', 'like', '%' . $search . '%')
                        ->orWhere('nim', 'like', '%' . $search . '%');
                })
                ->paginate(25);

                return view('dosen.rekomendasi.show', [
                        'rekomendasi' => $results,
                        'search' => $search
                ]);
            }
        
    
    }

    // admin kaprodi dekanat
    public function showAdmin(Request $request)
    {     
        // $user = Auth::user();
        // $role = $user->role;
        $search = $request->input('search');


        $rekomendasi = RekomendasiModel::join('mahasiswa', 'rekomendasi_akademik.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('dosen', 'mahasiswa.dosenpa_id', '=', 'dosen.id')
        ->select(
            'rekomendasi_akademik.*', 
            'mahasiswa.*',
            'dosen.*'
            )
            ->paginate(25);

        return view('admin.rekomendasi', [
                'rekomendasi' => $rekomendasi,
                'search' => $search
        ]);    
    }

    public function searchRekomendasi(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $results = RekomendasiModel::join('mahasiswa', 'rekomendasi_akademik.mahasiswa_id', '=', 'mahasiswa.id')

                ->select(
                    'rekomendasi_akademik.*', 
                    'mahasiswa.*'
                )
                ->where(function ($query) use ($search) {
                    $query->where('prodi', 'like', '%' . $search . '%')
                        ->orWhere('nama_mahasiswa', 'like', '%' . $search . '%')
                        ->orWhere('nim', 'like', '%' . $search . '%');
                })
                ->paginate(25);

                return view('admin.rekomendasi', [
                        'rekomendasi' => $results,
                        'search' => $search
                ]);
            }
        
    
    }


    public function add()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            $nim = $mahasiswa->nim;
            $prodi = $mahasiswa->prodi;
        }
        else {
            $nim = 'Anda belum memasukkan NIM di halaman Profile Saya';
            $prodi = 'Anda belum memaasukkan Jurusan di halaman Profile Saya';
        }    

        return view('mahasiswa.rekomendasi.add', [
            'nim'=>$nim,
            'prodi'=>$prodi,
        ]);
    }   

    public function save(Request $request)
    {   
        $request->validate([
            'khs_file' => 'nullable|mimes:pdf',
            'pkm_file' => 'nullable|mimes:pdf', 
            'toefl_file' => 'nullable|mimes:pdf',  
            'ukt_file' => 'nullable|mimes:pdf',  
            'seminar_file' => 'nullable|mimes:pdf',  
            'profesi_file' => 'nullable|mimes:pdf',  
        ]);

        $user = auth()->user();    
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        $rekomendasiData = [
            'mahasiswa_id' => $mahasiswa->id,
            'dosenpa_id' => $mahasiswa->dosenpa_id,
            'tanggal_pengajuan' => date('Y-m-d'),
            'sks' => $request->sks,
            'status' => 'Pending',
            'ket' => null,
        ];  
    
        $fileFields = ['khs_file', 'pkm_file', 'toefl_file', 'ukt_file', 'seminar_file', 'profesi_file'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $rekomendasiData[$field] = $request->file($field)->store("$field", 'public');
            }
        }

        RekomendasiModel::create($rekomendasiData);
    
        session()->flash('success', 'Pengajuan rekomendasi akademik berhasil dilakukan');
    
        return redirect()->route('rekomendasi.mahasiswa');
    }

    public function getRowData($id)
    {
        $rowData = RekomendasiModel::find($id);
        return response()->json($rowData);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $ket = $request->input('ket');
        
        $updatedRows = RekomendasiModel::where('id', $id)->update([
            'status' => $status,
            'ket'=> $ket,
        ]);

 
        session()->flash('success', 'Status pengajuan rekomendasi akademik berhasil diperbarui');

        return redirect()->route('rekomendasi.dosen');

        
    }

    public function exportRekomendasi()
    {
        return Excel::download(new ExportPengajuanRekomendasi, 'pengajuan-rekomendasi.xlsx');
    }

    public function exportRekomendasiDosen()
    {
        return Excel::download(new ExportPengajuanRekomendasiDosen, 'pengajuan-rekomendasi.xlsx');
    }
    
   

}
