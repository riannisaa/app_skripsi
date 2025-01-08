<?php

namespace App\Http\Controllers;

use App\Exports\ExportListTopik;
use App\Exports\ExportPengajuanTopik;

use App\Models\Dosen;
use App\Models\DataTopik;
use App\Models\Mahasiswa;
use App\Models\FormStatus;
use App\Models\TopikModel;
use Illuminate\Http\Request;
use App\Models\TopikDosenModel;
use App\Models\RekomendasiModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class TopikController extends Controller
{

    //mahasiswa
    public function show()
    {
        
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!isset($mahasiswa->peminatan)) {
            return view('mahasiswa.topik.show', [
                'messageDataDiri' => 'Anda belum mengisi data peminatan'
            ]);
        }

        $topik = TopikModel::where('mahasiswa_id', $mahasiswa->id)
        ->join('data_topik', 'data_topik.id', '=', 'pengajuan_topik.topik_id')
        ->select(
            'pengajuan_topik.*',
            'data_topik.*'
        )->get();
    
        $isButtonDisabled = true;
        $rekomendasi = RekomendasiModel::where('mahasiswa_id', $mahasiswa->id)->get();
        $isRekomendasiApproved = false;

        // Check if rekomendasi is approved
        if ($rekomendasi->isNotEmpty()) {
            foreach ($rekomendasi as $rek) {
                if ($rek->status === 'Disetujui') {
                    $isRekomendasiApproved = true;
                    $isButtonDisabled = false;
                    break;
                }
            }
        }
        
        if (!$isRekomendasiApproved) {
            return view('mahasiswa.topik.show', [
                'message' => 'Pengajuan rekomendasi dosen pembimbing akademik belum disetujui',
                'isButtonDisabled' => $isButtonDisabled,
                'isRekomendasiApproved' => $isRekomendasiApproved,
            ]);
        }

        $formStatus = FormStatus::where('form_id', 'topik')->first();

        if($formStatus->accepting_responses === 0){
            $isButtonDisabled = true;
            return view('mahasiswa.topik.show', [
                'message' => 'Form pengajuan topik telah ditutup',
                'isButtonDisabled' => $isButtonDisabled,
                'isRekomendasiApproved' => $isRekomendasiApproved,

            ]);
        }

        if ($topik->isNotEmpty()) {
            $lastTopik = $topik->last();
            if ($lastTopik->status === 'Ditolak') {
                $isButtonDisabled = false;
            } elseif (in_array($lastTopik->status, ['Pending', 'Disetujui'])) {
                $isButtonDisabled = true;
            }
        }

        return view('mahasiswa.topik.show', [
            'topik' => $topik,
            'isButtonDisabled' => $isButtonDisabled,
            'isRekomendasiApproved' => $isRekomendasiApproved,
        ]);
    }


    //kaprodi
    public function showAll(Request $request)
    {
        $search = $request->input('search');

        $data = TopikModel::join('mahasiswa', 'pengajuan_topik.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('data_topik', 'pengajuan_topik.topik_id', '=', 'data_topik.id') // Join with data_topik table
        ->select(
            'pengajuan_topik.id as pengajuan_id',
            'pengajuan_topik.mahasiswa_id',
            'pengajuan_topik.topik_id',
            'pengajuan_topik.judul',
            'pengajuan_topik.desc_judul',
            'pengajuan_topik.status',
            'pengajuan_topik.desc_status',
            'mahasiswa.*',
            'data_topik.topik' 
        )
        ->paginate(25);

        return view('kaprodi.topik.show', [
            'data' => $data,
            'search' => $search
        ]);

    }

    //dekanat admin
    public function showAdmin(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        $search = $request->input('search');

        $data = TopikModel::join('mahasiswa', 'pengajuan_topik.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('data_topik', 'pengajuan_topik.topik_id', '=', 'data_topik.id') // Join with data_topik table
        ->select(
            'pengajuan_topik.*',
            'mahasiswa.*',
            'data_topik.topik' // Select the name of the topik
        )
        ->paginate(25);
    
        return view('admin.topik', [
            'data' => $data,
            'search' => $search
        ]);

    }

    public function searchTopik(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        $search = $request->input('search');
    
        if ($search) {
            $results = TopikModel::join('mahasiswa', 'pengajuan_topik.mahasiswa_id', '=', 'mahasiswa.id')
                ->join('data_topik', 'pengajuan_topik.topik_id', '=', 'data_topik.id')
                ->select(
                    'pengajuan_topik.*',
                    'mahasiswa.*',
                    'data_topik.topik' 
                )
                ->where(function ($query) use ($search) {
                    $query->where('jurusan', 'like', '%' . $search . '%')
                        ->orWhere('nama_mahasiswa', 'like', '%' . $search . '%')
                        ->orWhere('nim', 'like', '%' . $search . '%');
                })
                ->paginate(25);
            
            if($role === 'kaprodi'){
                return view('kaprodi.topik.show', [
                    'data' => $results, 
                    'search' => $search,
                ]);

                return redirect()->route('topik.kaprodi');

            } elseif ($role === 'admin') {
                return view('admin.topik', [
                    'data' => $results, 
                    'search' => $search,
                ]);

                return redirect()->route('topik.admin');

            } elseif ($role === 'dekanat') {
                return view('dekanat.topik', [
                    'data' => $results, 
                    'search' => $search,
                ]);

                return redirect()->route('topik.dekanat');

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

        $topik = DataTopik::where('jurusan', $mahasiswa->prodi)
        ->where('peminatan', $mahasiswa->peminatan)
        ->pluck('topik', 'id');

        return view('mahasiswa.topik.add', [
            'nim' => $nim,
            'prodi' => $prodi,
            'peminatan' => $peminatan,
            'topik' => $topik,
        ]);
    }   

    public function save(Request $request)
    {
        $user = auth()->user();

        $dataTopik = DataTopik::where('id', $request->topik_id)->first();
        $existingTopikCount = $dataTopik->peserta;
        $maxTopikCount = $dataTopik->kapasitas;

        if ($existingTopikCount >= $maxTopikCount) {
            session()->flash('error', 'Kuota topik penuh. Harap pilih topik yang lain.');
            return redirect()->route('addTopik');
        }

        $checkTopik = TopikModel::where('topik_id', $request->topik_id)->first();

        if ($checkTopik) {
            if ($checkTopik->status !== 'Ditolak') {
                session()->flash('error', 'Anda sudah memilih topik ini sebelumnya.');
                return redirect()->route('addTopik');
            }
        }

        // $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        $topik = TopikModel::create([
            'mahasiswa_id' => $mahasiswa->id,
            'topik_id' => $request->topik_id,
            'judul' => $request->judul,
            'desc_judul' => $request->desc_judul,
            'status' => 'Pending',
            'desc_status' => null

        ]);

        DataTopik::where('topik', $request->topik)->increment('peserta');

        session()->flash('success', 'Pengajuan topik berhasil dilakukan');

        return redirect()->route('topik.mahasiswa');
    }

    public function getRowData($id)
    {
        $rowData = TopikModel::find($id);
        return response()->json($rowData);
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $desc_status = $request->input('desc_status');

        // dd($id, $status, $desc_status);

        
        $updatedRows = TopikModel::where('id', $id)->update([
            'status' => $status,
            'desc_status'=> $desc_status,
        ]);

        if ($status === 'Ditolak') {
            DataTopik::where('topik', $request->topik)->decrement('peserta');
        }

        if ($updatedRows === 0) {
            // No rows were updated, which could mean the record was not found
            return redirect()->route('topik.kaprodi')->with('error', 'Record not found');
        }
    
        session()->flash('success', 'Status pengajuan topik berhasil diperbarui');

        return redirect()->route('topik.kaprodi');

    }

    public function listTopik(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        $data = DataTopik::where('jurusan', $mahasiswa->prodi)->with('dosen')->paginate(25);
        $search = $request->input('search');


        return view('listtopik', [
            'data' => $data,
            'search' => $search
        ]);

    }

    public function searchListTopikMhs(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $search = $request->input('search');

        if ($search) {
            $results = DataTopik::where('jurusan', $mahasiswa->prodi)
            ->where(function ($query) use ($search) {
                $query->where('peminatan', 'like', '%' . $search . '%')
                    ->orWhere('topik', 'like', '%' . $search . '%');
            })->paginate(25);
        
            return view('listtopik', [
                'data' => $results, 
                'search' => $search
            ]);
        }

        return redirect()->route('listTopik');
    }


    public function listTopikAll(Request $request)
    {
        $data = DataTopik::with('dosen')->paginate(25);
        $allDosen = Dosen::all(); // Retrieve all lecturers from the database
        $search = $request->input('search');

        $user = Auth::user();
        $role = $user->role;

        if($role === 'kaprodi'){
            return view('kaprodi.topik.listtopik', [
                'data' => $data,
                'allDosen' => $allDosen,
                'search' => $search
            ]);
        } elseif ($role === 'admin' || $role ==='dekanat') {
            return view('admin.listtopik', [
                'data' => $data,
                'allDosen' => $allDosen,
                'search' => $search
            ]);
        }
    }

    //search daftar topik 
    public function searchListTopik(Request $request)
    {
        $search = $request->input('search');
        $allDosen = Dosen::all(); // Retrieve all lecturers from the database

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $role = $user->role;

        if ($search) {
            if($role === 'mahasiswa') {
                $results = DataTopik::where('jurusan', $mahasiswa->prodi)
                ->where(function ($query) use ($search) {
                    $query->where('peminatan', 'like', '%' . $search . '%')
                        ->orWhere('topik', 'like', '%' . $search . '%');
                })->paginate(25);
            
                return view('listtopik', [
                    'data' => $results, 
                    'search' => $search
                ]);
            } else {

                $results = DataTopik::where(function ($query) use ($search) {
                    $query->where('jurusan', 'like', '%' . $search . '%')
                        ->orWhere('peminatan', 'like', '%' . $search . '%')
                        ->orWhere('topik', 'like', '%' . $search . '%');
                })->paginate(25);

                if($role === 'kaprodi') {
                    return view('kaprodi.topik.listtopik', [
                        'data' => $results, 
                        'search' => $search,
                        'allDosen' => $allDosen,
        
                    ]);
                } elseif ($role === 'admin' || $role === 'dekanat'){
                    return view('admin.listtopik', [
                        'data' => $results, 
                        'search' => $search,
                        'allDosen' => $allDosen,
        
                    ]);

                }
            
            }


        }

        // return redirect()->route('listTopik.kaprodi');
    }

    public function getRowDataTopik($id)
    {
        $rowData = DataTopik::find($id);
        return response()->json($rowData);
    }


    public function editTopik($id)
    {
        $topik = DataTopik::with('dosen')->find($id);
        $allDosen = Dosen::all(); // Retrieve all lecturers from the database

        return view('kaprodi.topik.edit', [
            'topik' => $topik,
            'allDosen' => $allDosen
        ]);

    }

    public function updateTopik(Request $request)
    {
        $id = $request->input('id');
        $kapasitas = $request->input('kapasitas');
    
        $topik = DataTopik::findOrFail($id); // Use findOrFail to throw a 404 exception if the topik is not found
        $topik->update(['kapasitas' => $kapasitas]);
    
        // Sync the related 'dosen' records using the 'sync' method
        $topik->dosen()->sync($request->input('dosen'));
    
        session()->flash('success', 'Data topik berhasil diperbarui');
    
        return redirect()->route('listTopik.admin');
    }

    public function deleteTopik(Request $request)
    {
        $topik = DataTopik::find($request->id);

        if ($topik) {
            $topik->delete();
            // You can also add a success message or redirect to a different page
            return redirect()->route('listTopik.admin')->with('success', 'Topik berhasil dihapus');
        } else {
            // Handle the case when the topic is not found
            return redirect()->route('listTopik.admin')->with('error', 'Topik tidak ditemukan');
        }
    }

    public function addDataTopik(Request $request)
    {
        $request->validate([
            'jurusan' => 'required',
            'peminatan' => 'required',
            'topik' => 'required',
            'kapasitas' => 'required|numeric',
            'ket'=>'required',
            'dosen'=>'required'
        ]);

        // Create a new Topik instance
        $topik = new DataTopik();
        $topik->jurusan = $request->input('jurusan');
        $topik->peminatan = $request->input('peminatan');
        $topik->topik = $request->input('topik');
        $topik->ket = $request->input('ket');
        $topik->kapasitas = $request->input('kapasitas');

        // Save the Topik to the database
        $topik->save();

        $selectedDosenIds = $request->input('dosen');
        $topikId = $topik->id;
        
        foreach ($selectedDosenIds as $dosenId) {
            $topikDosen = new TopikDosenModel();
            $topikDosen->topik_id = $topikId;
            $topikDosen->dosen_id = $dosenId;
            $topikDosen->save();
        }

        // Redirect to the previous page with a success message
        return redirect()->back()->with('success', 'Topik berhasil ditambahkan');
    }

    public function export()
    {
        return Excel::download(new ExportListTopik, 'daftar-topik.xlsx');
    }

    public function exportTopik()
    {
        return Excel::download(new ExportPengajuanTopik, 'pengajuan-topik.xlsx');
    }

}
