<?php

namespace App\Http\Controllers;

use App\Exports\BerkasSkripsiExport;
use App\Models\BerkasSidangSkripsi;
use App\Models\DospemModel;
use App\Models\FormStatus;
use App\Models\HasilProposal;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BerkasSidangSkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function export(Request $request)
    {
        $prodi = $request->query('prodi');
        $user = auth()->user();
        $id = $user->role == 'dosen' ? $user->dosen->id : null;

        return Excel::download(new BerkasSkripsiExport($prodi, $id), 'berkas-skripsi.xlsx');
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {

            $passProposal = HasilProposal::whereHas('jadwalProposal.berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($user) {
                $query->where('nim', $user->mahasiswa->nim);
            })->whereHas('jadwalProposal.jadwalSidang', function ($query) {
                $query->where('done', true);
            })->first();

            if ($user->mahasiswa->prodi !== 'D3 Sistem Informasi' && !$passProposal) {
                return view('mahasiswa.skripsi.restricted');
            }
            if (!isset($user->mahasiswa->dospem)) {
                return view('mahasiswa.skripsi.index', [
                    'messageDospem' => 'Pengajuan dosen pembimbing anda belum sah'
                ]);
            }

            $skripsi = BerkasSidangSkripsi::where('id_pengajuan_dospem', $user->mahasiswa->dospem->id)->get();
            $isButtonDisabled = false;

            $formStatus = FormStatus::where('form_id', 'skripsi')->first();

            if ($formStatus->accepting_responses === 0) {
                $isButtonDisabled = true;
                return view('mahasiswa.skripsi.index', [
                    'skripsi' => $skripsi,
                    'message' => 'Form pendaftaran sidang skripsi telah ditutup',
                    'isButtonDisabled' => $isButtonDisabled,

                ]);
            }

            // status pengajuan
            if ($skripsi->isNotEmpty()) {
                // Check the status of the last submission
                $lastSkripsi = $skripsi->last();
                if ($lastSkripsi->status === 'Ditolak') {
                    $isButtonDisabled = false;
                } elseif (in_array($lastSkripsi->status, ['Pending', 'Disetujui'])) {
                    $isButtonDisabled = true;
                }
            }

            return view('mahasiswa.skripsi.index', [
                'skripsi' => $skripsi,
                'isButtonDisabled' => $isButtonDisabled,
            ]);
        } else if ($user->role === 'admin') {
            $prodi = $request->query('prodi');
            $search = $request->query('search') ?? '';

            $berkas = BerkasSidangSkripsi::whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
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

            return view('admin.skripsi.index', [
                'berkas' => $berkas,
                'prodi' => $prodi,
                'search' => $search
            ]);
        } else if ($user->role === 'kaprodi') {
            $prodi = $request->query('prodi');
            $search = $request->query('search') ?? '';

            $berkas = BerkasSidangSkripsi::whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
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

            return view('kaprodi.skripsi.index', [
                'berkas' => $berkas,
                'prodi' => $prodi,
                'search' => $search
            ]);
        } else if ($user->role === 'dosen') {
            $prodi = $request->query('prodi');
            $search = $request->query('search') ?? '';
            $dosenId = $user->dosen->id;

            $berkas = BerkasSidangSkripsi::whereHas('pengajuanDospem', function ($query) use ($dosenId) {
                $query->where('dp1_id', $dosenId)->orWhere('dp2_id', $dosenId)->orWhereHas('berkasSkripsi.jadwalSkripsi.jadwalSidang', function ($query) use ($dosenId) {
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

            return view('dosen.skripsi.index', [
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
        $skripsi = DospemModel::where('mahasiswa_id', $mahasiswa->id)->latest('created_at')->first();

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

        return view('mahasiswa.skripsi.create', ['dospem' => $skripsi, 'tahunAjaran' => $tahunAjaran]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'ktp_kk_akta' => 'required|mimes:pdf',
            'pas_foto' => 'required|mimes:jpg,jpeg,png',
            'ijazah' => 'required|mimes:pdf',
            'buku_bimbingan' => 'required|mimes:pdf',
            'turnitin' => 'required|mimes:pdf',
            'khs' => 'required|mimes:pdf',
            'kst' => 'required|mimes:pdf',
            'ukt' => 'required|mimes:pdf',
            'file_dokumen' => 'required|mimes:pdf',
            'video' => 'required|mimes:mp4,mov,avi,mkv',
            'bebas_pustaka' => 'nullable|mimes:pdf',
            'bebas_pinjam' => 'nullable|mimes:pdf',
        ], [
            'tahun_ajaran.required' => 'Tahun ajaran tidak boleh kosong.',
            'ktp_kk_akta.required' => 'File KTP, KK, dan Akta harus diunggah.',
            'ktp_kk_akta.mimes' => 'File KTP, KK, dan Akta harus berupa file PDF.',
            'pas_foto.required' => 'Pas foto harus diunggah.',
            'pas_foto.mimes' => 'Pas foto harus berupa file JPG, JPEG, atau PNG.',
            'ijazah.required' => 'Ijazah harus diunggah.',
            'ijazah.mimes' => 'Ijazah harus berupa file PDF.',
            'buku_bimbingan.required' => 'Buku Bimbingan harus diunggah.',
            'buku_bimbingan.mimes' => 'Buku Bimbingan harus berupa file PDF.',
            'turnitin.required' => 'Hasil Turnitin harus diunggah.',
            'turnitin.mimes' => 'Hasil Turnitin harus berupa file PDF.',
            'khs.required' => 'Kartu Hasil Studi (KHS) harus diunggah.',
            'khs.mimes' => 'Kartu Hasil Studi (KHS) harus berupa file PDF.',
            'kst.required' => 'Kartu Studi Tetap (KST) harus diunggah.',
            'kst.mimes' => 'Kartu Studi Tetap (KST) harus berupa file PDF.',
            'ukt.required' => 'Print out Pembayaran UKT harus diunggah.',
            'ukt.mimes' => 'Print out Pembayaran UKT harus berupa file PDF.',
            'file_dokumen.required' => 'File Skripsi harus diunggah.',
            'file_dokumen.mimes' => 'File Skripsi harus berupa file PDF.',
            'video.required' => 'Video Presentasi harus diunggah.',
            'video.mimes' => 'Video Presentasi harus berupa format: mp4, mov, avi, atau mkv.',
            'bebas_pustaka.mimes' => 'Surat Keterangan Bebas Pustaka harus berupa file PDF.',
            'bebas_pinjam.mimes' => 'Surat Keterangan Bebas Pinjam Alat Laboratorium harus berupa file PDF.',
        ]);

        $data = [
            'id_pengajuan_dospem' => $request->id_pengajuan_dospem,
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => 'Pending'
        ];

        // Proses file upload
        if ($request->hasFile('ktp_kk_akta')) {
            $data['ktp_kk_akta'] = $request->file('ktp_kk_akta')->store('files', 'public');
        }
        if ($request->hasFile('pas_foto')) {
            $data['pas_foto'] = $request->file('pas_foto')->store('images', 'public');
        }
        if ($request->hasFile('ijazah')) {
            $data['ijazah'] = $request->file('ijazah')->store('files', 'public');
        }
        if ($request->hasFile('buku_bimbingan')) {
            $data['buku_bimbingan'] = $request->file('buku_bimbingan')->store('files', 'public');
        }
        if ($request->hasFile('turnitin')) {
            $data['turnitin'] = $request->file('turnitin')->store('files', 'public');
        }
        if ($request->hasFile('khs')) {
            $data['khs'] = $request->file('khs')->store('files', 'public');
        }
        if ($request->hasFile('kst')) {
            $data['kst'] = $request->file('kst')->store('files', 'public');
        }
        if ($request->hasFile('ukt')) {
            $data['ukt'] = $request->file('ukt')->store('files', 'public');
        }
        if ($request->hasFile('file_dokumen')) {
            $data['file_dokumen'] = $request->file('file_dokumen')->store('files', 'public');
        }
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('videos', 'public');
        }
        if ($request->hasFile('bebas_pustaka')) {
            $data['bebas_pustaka'] = $request->file('bebas_pustaka')->store('files', 'public');
        }
        if ($request->hasFile('bebas_pinjam')) {
            $data['bebas_pinjam'] = $request->file('bebas_pinjam')->store('files', 'public');
        }

        BerkasSidangSkripsi::create($data);

        session()->flash('success', 'Pendaftaran sidang skripsi berhasil dilakukan');
        return redirect()->route('berkas-skripsi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BerkasSidangSkripsi $berkasSidangSkripsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BerkasSidangSkripsi $berkasSidangSkripsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BerkasSidangSkripsi $berkasSidangSkripsi)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        BerkasSidangSkripsi::where('id', $request->id)->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->withSuccess('Status pendaftaran sidang skripsi berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BerkasSidangSkripsi $berkasSidangSkripsi)
    {
        //
    }
}
