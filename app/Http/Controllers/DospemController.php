<?php

namespace App\Http\Controllers;

use App\Exports\ExportListDospem;
use App\Exports\ExportPengajuanDospem;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\DataDospem;
use App\Models\FormStatus;
use App\Models\TopikModel;
use App\Models\DospemModel;
use Illuminate\Http\Request;
use App\Models\TopikDosenModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DospemController extends Controller
{
 
    //mahasiswa
    public function show() 
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!isset($mahasiswa->peminatan)) {
            return view('mahasiswa.dospem.show', [
                'messageDataDiri' => 'Anda belum mengisi data peminatan'
            ]);
        }

        $dospem = DospemModel::where('mahasiswa_id', $mahasiswa->id)
        ->join('dosen as dp1', 'dp1.id', '=', 'pengajuan_dospem.dp1_id')
           ->leftJoin('dosen as dp2', 'dp2.id', '=', 'pengajuan_dospem.dp2_id')
        ->select(
            'pengajuan_dospem.*',
            'dp1.nama_dosen as nama_dp1',
            'dp2.nama_dosen as nama_dp2'
        )->get();


        $isButtonDisabled = true;

        $topik = TopikModel::where('mahasiswa_id', $mahasiswa->id)->get();
        $isTopikApproved = false;

        // Cek status topik
        if ($topik->isNotEmpty()) {
            foreach ($topik as $top) {
                if ($top->status === 'Disetujui') {
                    $isTopikApproved = true;
                    $isButtonDisabled = false;
                    break;
                }
            }
        }

        if(!$isTopikApproved){
            return view('mahasiswa.dospem.show', [
                'message' => 'Pengajuan topik skripsi/tugas akhir  belum disetujui',
                'isButtonDisabled' => $isButtonDisabled,
                'isTopikApproved' => $isTopikApproved,
        ]);

        }

        $formStatus = FormStatus::where('form_id', 'dospem')->first();

        if($formStatus->status === 0){
            $isButtonDisabled = true;
            return view('mahasiswa.topik.show', [
                'message' => 'Form pengajuan topik telah ditutup',
                'isButtonDisabled' => $isButtonDisabled,
                'isTopikApproved' => $isTopikApproved,

            ]);
        }

        if ($dospem->isNotEmpty()) {
            $lastDospem = $dospem->last();
            if ($lastDospem->status === 'Ditolak') {
                $isButtonDisabled = false;
            } elseif (in_array($lastDospem->status, ['Pending', 'Disetujui', 'Sah', 'Lulus'])) {
                $isButtonDisabled = true;
            }
        }

        return view('mahasiswa.dospem.show', [
            'dospem' => $dospem,
            'isButtonDisabled' => $isButtonDisabled,
            'isTopikApproved' => $isTopikApproved,   
                 
        ]);
    }

 

    public function searchDosen(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        $search = $request->input('search');
        $dospem = Dosen::pluck('nama_dosen', 'id');

    
        if ($search) {
            $results = DospemModel::join('mahasiswa', 'pengajuan_dospem.mahasiswa_id', '=', 'mahasiswa.id')
                ->join('dosen as dp1', 'dp1.id', '=', 'pengajuan_dospem.dp1_id')
                ->leftJoin('dosen as dp2', 'dp2.id', '=', 'pengajuan_dospem.dp2_id')
                ->select(
                    'pengajuan_dospem.*',
                    'mahasiswa.nama_mahasiswa',
                    'mahasiswa.nim',
                    'mahasiswa.prodi',
                    'dp1.nama_dosen as nama_dp1',
                    'dp2.nama_dosen as nama_dp2'
                )
                ->where('dp1.nama_dosen', 'like', '%' . $search . '%')
                ->orWhere('dp2.nama_dosen', 'like', '%' . $search . '%')
                ->paginate(25);
    
            if ($role === 'kaprodi') {
                return view('kaprodi.dospem.show', [
                    'data' => $results,
                    'search' => $search,
                    'dospem' => $dospem,

                ]);
            } elseif ($role === 'admin') {
                return view('admin.dospem', [
                    'data' => $results,
                    'search' => $search,
                    'dospem' => $dospem,

                ]);
            } elseif ($role === 'dekanat') {
                return view('dekanat.dospem', [
                    'data' => $results,
                    'search' => $search,
                    'dospem' => $dospem,

                ]);
            }
        }
    }
    

    public function showAdmin(Request $request)
    {
        $search = $request->input('search');

        $data = DospemModel::join('mahasiswa', 'pengajuan_dospem.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('dosen as dp1', 'dp1.id', '=', 'pengajuan_dospem.dp1_id')
        ->leftJoin('dosen as dp2', 'dp2.id', '=', 'pengajuan_dospem.dp2_id')
        ->select(
            'pengajuan_dospem.*',
            'mahasiswa.nama_mahasiswa',
            'mahasiswa.nim',
            'mahasiswa.prodi',
            'dp1.nama_dosen as nama_dp1',
            'dp2.nama_dosen as nama_dp2'
        )
        ->paginate(25);
    
        $dospem = Dosen::pluck('nama_dosen', 'id');
        return view('admin.dospem', [
            'data' => $data,
            'dospem' => $dospem,
            'search' => $search

        ]);
    }

    public function showDekanat(Request $request)
    {
        $search = $request->input('search');

        $data = DospemModel::join('mahasiswa', 'pengajuan_dospem.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('dosen as dp1', 'dp1.id', '=', 'pengajuan_dospem.dp1_id')
        ->leftJoin('dosen as dp2', 'dp2.id', '=', 'pengajuan_dospem.dp2_id')
        ->select(
            'pengajuan_dospem.*',
            'mahasiswa.nama_mahasiswa',
            'mahasiswa.nim',
            'mahasiswa.prodi',
            'dp1.nama_dosen as nama_dp1',
            'dp2.nama_dosen as nama_dp2'
        )
        ->paginate(25);
    
        $dospem = Dosen::pluck('nama_dosen', 'id');
        return view('dekanat.dospem', [
            'data' => $data,
            'dospem' => $dospem,
            'search' => $search

        ]);
    }

    //dosen
    public function showDosen(Request $request)
    {
        $user = auth()->user();
        $dosen = Dosen::where('user_id', $user->id)->first();
        $dosen_id = $dosen->id;
        $search = $request->input('search');


        $data = DospemModel::join('mahasiswa', 'pengajuan_dospem.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('dosen as dp1', 'pengajuan_dospem.dp1_id', '=', 'dp1.id')
        ->leftJoin('dosen as dp2', 'pengajuan_dospem.dp2_id', '=', 'dp2.id')
        ->select(
            'pengajuan_dospem.*',
            'dp1.nama_dosen as nama_dp1', // Alias for dp1 nama_dosen
            'dp2.nama_dosen as nama_dp2', // Alias for dp2 nama_dosen
            'mahasiswa.nama_mahasiswa',
            'mahasiswa.nim',
            'mahasiswa.prodi'
        )
        ->where('pengajuan_dospem.dp1_id', $dosen_id)
        ->orWhere('pengajuan_dospem.dp2_id', $dosen_id)
        ->paginate(25);


        return view('dosen.dospem.show', [
            'data' => $data,
            'dosen_id' => $dosen_id,
            'search' => $search
        ]);

    }

    public function getRowData($id)
    {
        $rowData = DospemModel::find($id);
        return response()->json($rowData);
    }

    //KAPRODI

    public function showAll(Request $request)
    {
        $search = $request->input('search');

        $data = DospemModel::join('mahasiswa', 'pengajuan_dospem.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('dosen as dp1', 'dp1.id', '=', 'pengajuan_dospem.dp1_id')
        ->leftJoin('dosen as dp2', 'dp2.id', '=', 'pengajuan_dospem.dp2_id')
        ->select(
            'pengajuan_dospem.*',
            'mahasiswa.nama_mahasiswa',
            'mahasiswa.nim',
            'mahasiswa.prodi',
            'dp1.nama_dosen as nama_dp1',
            'dp2.nama_dosen as nama_dp2'
        )
        ->paginate(25);

        $dospem = Dosen::pluck('nama_dosen', 'id');

        return view('kaprodi.dospem.show', [
            'data' => $data,
            'search' => $search,
            'dospem' => $dospem
        ]);
    }

    public function editDosenPembimbing($id)
    {
        $data = DospemModel::join('mahasiswa', 'pengajuan_dospem.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('dosen as dp1', 'dp1.id', '=', 'pengajuan_dospem.dp1_id')
        ->leftJoin('dosen as dp2', 'dp2.id', '=', 'pengajuan_dospem.dp2_id')
        ->select(
            'pengajuan_dospem.*',
            'mahasiswa.nama_mahasiswa',
            'mahasiswa.nim',
            'mahasiswa.prodi',
            'dp1.nama_dosen as nama_dp1',
            'dp2.nama_dosen as nama_dp2'
        )
        ->where('pengajuan_dospem.id', $id)
        ->first();

        $allDosen = Dosen::all();
        $dospem = Dosen::pluck('nama_dosen', 'id');

        return view('kaprodi.dospem.editdosen', [
            'data' => $data,
            'allDosen' => $allDosen,
            'dospem' => $dospem
        ]);
    }

    public function updateDosenPembimbing(Request $request)
    {
        $id = $request->input('id');
        $namadosen = $request->input('dp1_id');
        $dosenPembimbing1 = Dosen::where('nama_dosen', $namadosen)->first()->id;
        $dosenPembimbing2 = $request->input('dp2_id');

        // dd($id, $dosenPembimbing1, $dosenPembimbing2);

        $dataDospem = Dosen::where('id', $dosenPembimbing2)->first();

        if ($dataDospem) {
            $existingDospemCount = $dataDospem->peserta_dp2;
            $maxDospemCount = $dataDospem->kapasitas_dp2;
            if ($existingDospemCount >= $maxDospemCount) {
                session()->flash('error', 'Kuota dosen pembimbing penuh. Harap pilih dosen pembimbing yang lain.');
                return back();
            }
        } 

        if($dosenPembimbing1 == $dosenPembimbing2)
        {
            session()->flash('error', 'Tidak boleh memilih dosen pembimbing yang sama.');
            return back();
        }

        DospemModel::where('id', $id)->update([
            'dp2_id'=>$dosenPembimbing2,
        ]);

        Dosen::where('id', $request->dp2_id)->increment('peserta_dp2'); //increment dospem 2


        session()->flash('success', 'Data dosen pembimbing berhasil diperbarui');
        return redirect()->route('dospem.kaprodi');
    }

    //pengesahan dospem
    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
   
        $updatedRows = DospemModel::where('id', $id)->update([
            'status' => "Sah",
        ]);
        
        if ($updatedRows === 0) {
            return redirect()->route('dospem.kaprodi')->with('error', 'Record not found');
        }

        session()->flash('success', 'Status pengajuan dosen pembimbing berhasil diperbarui');

        return redirect()->route('dospem.kaprodi');
    }

    //persetujuan dosen pembimbing 1
    public function approveDosen(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $desc_status = $request->input('desc_status');
        $dp_1 = $request->input('dp_1');
        $dp_2 = $request->input('dp_2');
        
        $updatedRows = DospemModel::where('id', $id)->update([
            'status' => $status,
            'desc_status'=> $desc_status,
            // 'dp_2'=>$dxp_2,
        ]);

        if ($status === 'Ditolak') {
            Dosen::where('id', $request->dp1_id)->decrement('peserta_dp1'); 
        } 
        
        // if ($status === 'Disetujui'){
        //     Dosen::where('nama_dosen', $request->dp_2)->increment('peserta_dp2'); //increment dospem 2
        // }

        if ($updatedRows === 0) {
            // No rows were updated, which could mean the record was not found
            return redirect()->route('dospem.dosen')->with('error', 'Record not found');
        }

        session()->flash('success', 'Status pengajuan dosen pembimbing berhasil diperbarui');

        return redirect()->route('dospem.dosen');
    }

    // public function inputDosen(Request $request)
    // {
    //     $id = $request->input('id');
    //     $dp1_id = $request->input('dp1_id');
    //     $dp2_id = $request->input('dp2_id');

        
    //     $dataDospem = Dosen::where('id', $dp2_id)->first();

    //     if ($dataDospem) {
    //         $existingDospemCount = $dataDospem->peserta_dp2;
    //         $maxDospemCount = $dataDospem->kapasitas_dp2;
    //         if ($existingDospemCount >= $maxDospemCount) {
    //             session()->flash('error', 'Kuota dosen pembimbing penuh. Harap pilih dosen pembimbing yang lain.');
    //             return back();
    //         }
    //     } 

    //     if($dp1_id === $dp2_id)
    //     {
    //         session()->flash('error', 'Tidak boleh memilih dosen pembimbing yang sama.');
    //         return back();
    //     }

    //     DospemModel::where('id', $id)->update([
    //         'dp2_id'=>$dp2_id,
    //     ]);

    //     Dosen::where('id', $request->dp2_id)->increment('peserta_dp2'); //increment dospem 2

    //     session()->flash('success', 'Dosen pembimbing 2 berhasil ditambahkan');

    //     return redirect()->route('dospem.kaprodi');
    // }


    public function getRowDataDospem($id)
    {
        $rowData = Dosen::find($id);
        return response()->json($rowData);
    }

    public function updateDospem(Request $request)
    {
        $id = $request->input('id');
        $kapasitas_dp1 = $request->input('kapasitas_dp1');
        $kapasitas_dp2 = $request->input('kapasitas_dp2');

        $updatedRows = Dosen::where('id', $id)->update([
            'kapasitas_dp1' => $kapasitas_dp1,
            'kapasitas_dp2'=> $kapasitas_dp2,
        ]);
        
        session()->flash('success', 'Kapasitas dosen pembimbing berhasil diperbarui');

        return redirect()->route('listDosen.kaprodi');
    }

    
    public function listDosen(Request $request)
    {
        $search = $request->input('search');
        $data = Dosen::with('topik')->paginate(25);

        return view('listdosen', [
            'data' => $data,
            'search' => $search
        ]);
    } 

    public function listDosenAll(Request $request)
    {
        // $data = Dosen::get();
        $search = $request->input('search');

        $data = Dosen::with('topik')->paginate(25);

        return view('kaprodi.dospem.listdosen', [
            'data' => $data,
            'search' => $search
        ]);
    } 

    // search list dosen
    public function searchListDosen(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        $search = $request->input('search');

        if ($search) {
            $results = Dosen::where('nama_dosen', 'like', '%' . $search . '%')
                ->paginate(25);

            if($role === 'kaprodi'){
                return view('kaprodi.dospem.listdosen', [
                    'data' => $results, 
                    'search' => $search
                ]);

                return redirect()->route('listDosen.kaprodi'); 
            } elseif($role === 'mahasiswa' || $role === 'admin' || $role === 'dekanat'){
                return view('listdosen', [
                    'data' => $results, 
                    'search' => $search
                ]);

                return redirect()->route('listDosen');
            } 
        }

    }    
    
    public function add()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            $nim = $mahasiswa->nim;
            $prodi = $mahasiswa->prodi;
            $peminatan = $mahasiswa->peminatan;
        } else {
            // Set default values if $mahasiswa doesn't exist
            $nim = 'Anda belum memasukkan NIM di halaman Profile Saya';
            $prodi = 'Anda belum memaasukkan Jurusan di halaman Profile Saya';
            $peminatan = 'Anda belum memaasukkan Peminatan di halaman Profile Saya';
        }

        $dataTopik = TopikModel::where('mahasiswa_id', $mahasiswa->id)
        ->where('status', 'Disetujui')
        ->join('data_topik', 'data_topik.id', '=', 'pengajuan_topik.topik_id')
        ->select(
            'pengajuan_topik.*',
            'data_topik.*'
        )
        ->first();
    
        $topik = $dataTopik->topik;
        $judul = $dataTopik->judul;

        $dataDospem = TopikDosenModel::where('topik_id', $dataTopik->id)
        ->join('dosen', 'topik_dosen.dosen_id', '=', 'dosen.id')
        ->pluck('dosen.nama_dosen', 'dosen.id');

        return view('mahasiswa.dospem.add', [
            'nim' => $nim,
            'prodi' => $prodi,
            'peminatan' => $peminatan,
            'topik' => $topik,
            'judul' => $judul,
            'dospem'=> $dataDospem,
        ]);
    }   

    public function save(Request $request)
    {        
        $dataDospem = Dosen::where('id', $request->dp1_id)->first();

        if ($dataDospem) {
            $existingDospemCount = $dataDospem->peserta_dp1;
            $maxDospemCount = $dataDospem->kapasitas_dp1;
            if ($existingDospemCount >= $maxDospemCount) {
                session()->flash('error', 'Kuota dosen pembimbing penuh. Harap pilih dosen pembimbing yang lain.');
                return redirect()->route('addDospem');
            }
        } else {
            session()->flash('error', 'Dosen pembimbing tidak ditemukan. Harap pilih dosen pembimbing yang valid.');
            return redirect()->route('addDospem');
        }

        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        DospemModel::create([
            'mahasiswa_id' => $mahasiswa->id,
            'topik' => $request->topik,
            'judul' => $request->judul,
            'dp1_id' =>$request->dp1_id,
            'status' => 'Pending',
            'desc_status' => null

        ]);

        Dosen::where('id', $request->dp1_id)->increment('peserta_dp1');

        session()->flash('success', 'Pengajuan dosen pembimbing berhasil dilakukan');

        return redirect()->route('dospem.mahasiswa');
    }

    public function exportDospem()
    {
        return Excel::download(new ExportPengajuanDospem, 'pengajuan-dospem.xlsx');
    }

    public function exportListDospem()
    {
        return Excel::download(new ExportListDospem, 'daftar-dospem.xlsx');
    }
}
