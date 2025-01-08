<?php

namespace App\Http\Controllers;

use App\Exports\JadwalSkripsiExport;
use App\Models\BerkasSidangSkripsi;
use App\Models\JadwalSidang;
use App\Models\JadwalSkripsi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JadwalSkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function export(Request $request)
    {
        $prodi = $request->query('prodi');
        $id = $request->query('id') ?? null;

        $data = JadwalSkripsi::with('berkasSkripsi.pengajuanDospem')
            ->with('jadwalSidang.plotJadwal')
            ->whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
                $query->where('prodi', $prodi);
            })->whereHas('jadwalSidang.plotJadwal', function ($query) {
                $query->orderBy('tanggal', 'desc');
            })->get();

        if ($id) {
            $data = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
                $query->where('prodi', $prodi);
            })->whereHas('jadwalSidang', function ($query) use ($id) {
                $query->where('id_penguji_1', $id)->orWhere('id_penguji_2', $id)->orWhere('id_pembimbing', $id)->orWhereHas('jadwalProposals.berkasProposal.pengajuanDospem', function ($q) use ($id) {
                    $q->where('dp1_id', $id)->orWhere('dp2_id', $id);
                });
            })->whereHas('jadwalSidang.plotJadwal', function ($query) {
                $query->orderBy('tanggal', 'desc');
            })->get();
        }

        return Pdf::loadView('pdf.jadwal-skripsi', ['jadwal' => $data])->setPaper('a4', 'landscape')->stream('jadwal-skripsi.pdf');
    }
    public function index(Request $request)
    {
        $prodi = $request->query('prodi');
        $search = $request->input('search');

        $berkas = BerkasSidangSkripsi::where('status', 'Disetujui')->whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })->whereDoesntHave('jadwalSkripsi')->with('pengajuanDospem.mahasiswa')->get();

        $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })->paginate(10);

        if ($search) {
            $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi)->where('nama_mahasiswa', 'like', "%$search%")->orWhere('nim', 'like', "%$search%");
            })->paginate(10);
        }


        if (auth()->user()->role === 'admin') {
            return view('admin.jadwal-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'kaprodi') {
            return view('kaprodi.jadwal-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'dosen') {

            $dosenId = auth()->user()->dosen->id;

            $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi);

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })->whereHas('jadwalSidang', function ($query) use ($dosenId) {
                $query->where('id_penguji_1', $dosenId)->orWhere('id_penguji_2', $dosenId)->orWhere('id_pembimbing', $dosenId)->orWhereHas('jadwalSkripsi.berkasSkripsi.pengajuanDospem', function ($q) use ($dosenId) {
                    $q->where('dp1_id', $dosenId)->orWhere('dp2_id', $dosenId);
                });
            })->paginate(10);

            return view('dosen.jadwal-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'mahasiswa') {

            $mahasiswaId = auth()->user()->mahasiswa->id;

            $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem', function ($query) use ($mahasiswaId) {
                $query->where('mahasiswa_id', $mahasiswaId);
            })->whereHas('jadwalSidang', function ($query) {
                $query->where('status', 'Disetujui');
            })->paginate(5);

            return view('mahasiswa.jadwal-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas
            ]);
        }
    }

    public function accDosen(Request $request)
    {
        $id = $request->query('id');

        foreach ($request->query() as $key => $value) {
            $jadwal = JadwalSkripsi::find($id);
            $jadwal->update([
                "$key" => $value
            ]);
            $jadwal->save();
        }

        return redirect()->back()->withSuccess('Status acc skripsi berhasil diperbaharui');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $prodi = $request->query('prodi');

        $berkas = BerkasSidangSkripsi::where('status', 'Disetujui')
            ->whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
                $query->where('prodi', $prodi);
            })
            ->where(function ($query) {
                $query->whereHas('jadwalSkripsi.jadwalSidang', function ($query) {
                    $query->where('status', 'Ditolak');
                })
                ->whereDoesntHave('jadwalSkripsi.jadwalSidang', function ($query) {
                    $query->where('status', 'Pending')->orWhere('status', 'Disetujui');
                })
                ->orWhereDoesntHave('jadwalSkripsi');
            })
            ->get();

        return view('admin.jadwal-skripsi.create', [
            'prodi' => $prodi,
            'berkas' => $berkas
        ]);
    }

    public function updateStatus(Request $request)
    {
        $sidang = JadwalSidang::find($request->id);
        $sidang->status = $request->status;
        $sidang->keterangan = $request->keterangan;
        $sidang->save();

        return redirect()->back()->withSuccess('Status jadwal sidang skripsi berhasil diperbaharui');
    }

    public function updatePustaka(Request $request)
    {
        $sidang = JadwalSkripsi::find($request->id);
        $sidang->bebas_pustaka = $request->bebas_pustaka;
        $sidang->save();

        return redirect()->back()->withSuccess('Status bebas pustaka berhasil diperbaharui');
    }

    public function uploadFile(Request $request)
    {
        $jadwal = JadwalSkripsi::find($request->id);

        if ($request->hasFile('file') && $request->berkas == 'file_skripsi') {
            $jadwal->file_skripsi = $request->file('file')->store('files', 'public');
            $jadwal->save();

            return redirect()->back()->withSuccess('Berkas file skripsi berhasil diunggah.');
        }


        if ($request->hasFile('file') && $request->berkas == 'file_revisi') {
            $jadwal->file_revisi = $request->file('file')->store('files', 'public');
            $jadwal->save();

            return redirect()->back()->withSuccess('Berkas file revisi berhasil diunggah.');
        }

        if ($request->hasFile('file') && $request->berkas == 'file_pengesahan') {
            $jadwal->file_pengesahan = $request->file('file')->store('files', 'public');
            $jadwal->save();

            return redirect()->back()->withSuccess('Berkas file pengesahan berhasil diunggah.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        preg_match('/-(\d+)/', $request->berkas, $matches);
        $idBerkas = intval($matches[1]);

        $sidang = JadwalSidang::create([
            'id_penguji_1' => $request->id_penguji_1,
            'id_penguji_2' => $request->id_penguji_2,
            'id_pembimbing' => $request->id_dospem,
            'id_plot_jadwal' => $request->id_plot_jadwal,
            'status' => 'Pending'
        ]);

        JadwalSkripsi::create([
            'id_berkas_skripsi' => $idBerkas,
            'id_jadwal' => $sidang->id
        ]);

        return redirect()->route('jadwal-skripsi.index', ['prodi' => $request->prodi])->withSuccess('Jadwal Sidang Skripsi berhasil dibuat');
    }

    public function revisi(Request $request)
    {
        $sidang = JadwalSkripsi::find($request->id);
        $sidang->status_revisi = $request->status;
        $sidang->save();

        return redirect()->back()->withSuccess('Status revisi berhasil diperbaharui');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalSkripsi $jadwalSkripsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalSkripsi $jadwalSkripsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalSkripsi $jadwalSkripsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalSkripsi $jadwalSkripsi)
    {
        //
    }
}
