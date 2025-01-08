<?php

namespace App\Http\Controllers;

use App\Exports\BerkasProposalExport;
use App\Models\BerkasSidangProposal;
use App\Models\DospemModel;
use App\Models\FormStatus;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BerkasSidangProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function export(Request $request)
    {
        $prodi = $request->query('prodi');
        $user = auth()->user();
        $id = $user->role == 'dosen' ? $user->dosen->id : null;

        return Excel::download(new BerkasProposalExport($prodi, $id), 'berkas-proposal.xlsx');
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {

            if (!isset($user->mahasiswa->dospem)) {
                return view('mahasiswa.proposal.index', [
                    'messageDospem' => 'Pengajuan dosen pembimbing anda belum sah'
                ]);
            }

            $proposal = BerkasSidangProposal::where('id_pengajuan_dospem', $user->mahasiswa->dospem->id)->get();
            $isButtonDisabled = false;

            $formStatus = FormStatus::where('form_id', 'proposal')->first();

            if ($formStatus->accepting_responses === 0) {
                $isButtonDisabled = true;
                return view('mahasiswa.proposal.index', [
                    'proposal' => $proposal,
                    'message' => 'Form pendaftaran sidang proposal telah ditutup',
                    'isButtonDisabled' => $isButtonDisabled,

                ]);
            }

            // status pengajuan
            if ($proposal->isNotEmpty()) {
                // Check the status of the last submission
                $lastProposal = $proposal->last();
                if ($lastProposal->status === 'Ditolak') {
                    $isButtonDisabled = false;
                } elseif (in_array($lastProposal->status, ['Pending', 'Disetujui'])) {
                    $isButtonDisabled = true;
                }
            }


            return view('mahasiswa.proposal.index', [
                'proposal' => $proposal,
                'isButtonDisabled' => $isButtonDisabled,
            ]);
        } else if ($user->role === 'admin' || $user->role === 'kaprodi') {
            $prodi = $request->query('prodi');
            $search = $request->query('search') ?? '';

            $berkas = BerkasSidangProposal::whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                if ($prodi) {
                    $query->where('prodi', $prodi);
                }

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })->paginate(10);

            return view('admin.proposal.index', [
                'berkas' => $berkas,
                'prodi' => $prodi,
                'search' => $search
            ]);
        } else if ($user->role === 'kaprodi') {
            $prodi = $request->query('prodi');
            $search = $request->query('search') ?? '';

            $berkas = BerkasSidangProposal::whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                if ($prodi) {
                    $query->where('prodi', $prodi);
                }

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })->paginate(10);

            return view('kaprodi.proposal.index', [
                'berkas' => $berkas,
                'prodi' => $prodi,
                'search' => $search
            ]);
        } else if ($user->role === 'dosen') {
            $prodi = $request->query('prodi');
            $search = $request->query('search') ?? '';
            $dosenId = $user->dosen->id;

            $berkas = BerkasSidangProposal::whereHas('pengajuanDospem', function ($query) use ($dosenId) {
                $query->where('dp1_id', $dosenId)->orWhere('dp2_id', $dosenId)->orWhereHas('berkasProposal.jadwalProposals.jadwalSidang', function ($query) use ($dosenId) {
                    $query->where('id_penguji_1', $dosenId)->orWhere('id_penguji_2', $dosenId);
                });
            })->whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                if ($prodi) {
                    $query->where('prodi', $prodi);
                }

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })->paginate(10);

            return view('dosen.proposal.index', [
                'berkas' => $berkas,
                'prodi' => $prodi,
                'search' => $search
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $proposal = DospemModel::where('mahasiswa_id', $mahasiswa->id)->latest('created_at')->first();

        $carbonDate = Carbon::now();

        // Extract year and month
        $year = $carbonDate->year;
        $month = $carbonDate->month;

        // Determine the semester and academic year
        if ($month >= 8 && $month <= 12) {
            // Ganjil semester: August to December
            $tahunAjaran = $year . "/" . ($year + 1) . " Ganjil";
        } else {
            // Genap semester: January to July
            $tahunAjaran = ($year - 1) . "/" . $year . " Genap";
        }

        return view('mahasiswa.proposal.create', ['dospem' => $proposal, 'tahunAjaran' => $tahunAjaran]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->tahun_ajaran || !$request->jenis_sidang) {
        }

        $request->validate([
            'buku_bimbingan' => 'mimes:pdf',
            'khs' => 'mimes:pdf',
            'kst' => 'mimes:pdf',
            'video' => 'mimes:mp4,mov,avi,mkv',
            'file_dokumen' => 'mimes:pdf',
            'jenis_sidang' => 'required',
            'tahun_ajaran' => 'required'
        ], [
            'buku_bimbingan.mimes' => 'Buku Bimbingan harus berupa file pdf.',
            'khs.mimes' => 'KHS harus berupa file pdf.',
            'kst.mimes' => 'KST harus berupa file pdf.',
            'video.mimes' => 'Video harus berupa format: mp4, mov, avi, mkv.',
            'file_dokumen.mimes' => 'Dokumen Proposal/Skripsi harus berupa file pdf.',
            'jenis_sidang.required' => 'Jenis sidang tidak boleh kosong.',
            'tahun_ajaran.required' => 'Tahun ajaran tidak boleh kosong.',
        ]);

        $data = [
            'id_pengajuan_dospem' => $request->id_pengajuan_dospem,
            'tahun_ajaran' => $request->tahun_ajaran,
            'jenis_sidang' => $request->jenis_sidang,
            'status' => 'Pending'
        ];

        if ($request->hasFile('buku_bimbingan')) {
            $data['buku_bimbingan'] = $request->file('buku_bimbingan')->store('files', 'public');
        }
        if ($request->hasFile('khs')) {
            $data['khs'] = $request->file('khs')->store('files', 'public');
        }
        if ($request->hasFile('kst')) {
            $data['kst'] = $request->file('kst')->store('files', 'public');
        }
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('videos', 'public');
        }
        if ($request->hasFile('file_dokumen')) {
            $data['file_dokumen'] = $request->file('file_dokumen')->store('files', 'public');
        }

        BerkasSidangProposal::create($data);

        session()->flash('success', 'Pendaftaran sidang proposal berhasil dilakukan');
        return redirect()->route('berkas-proposal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BerkasSidangProposal $berkasSidangProposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BerkasSidangProposal $berkasSidangProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BerkasSidangProposal $berkasSidangProposal)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        BerkasSidangProposal::where('id', $request->id)->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->withSuccess('Status pendaftaran sidang proposal berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BerkasSidangProposal $berkasSidangProposal)
    {
        //
    }
}
