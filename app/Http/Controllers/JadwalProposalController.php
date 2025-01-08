<?php

namespace App\Http\Controllers;

use App\Exports\JadwalProposalExport;
use App\Models\BerkasSidangProposal;
use App\Models\JadwalProposal;
use App\Models\JadwalSidang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JadwalProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function export(Request $request)
    {
        $prodi = $request->query('prodi');
        $id = $request->query('id') ?? null;

        $data = JadwalProposal::with('berkasProposal.pengajuanDospem')
            ->with('jadwalSidang.plotJadwal')
            ->whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
                $query->where('prodi', $prodi);
            })->whereHas('jadwalSidang.plotJadwal', function ($query){
                $query->orderBy('tanggal', 'desc');
            })->get();

        if($id){
            $data = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
                $query->where('prodi', $prodi);
            })->whereHas('jadwalSidang', function ($query) use ($id) {
                $query->where('id_penguji_1', $id)->orWhere('id_penguji_2', $id)->orWhere('id_pembimbing', $id)->orWhereHas('jadwalProposals.berkasProposal.pengajuanDospem', function ($q) use ($id) {
                    $q->where('dp1_id', $id)->orWhere('dp2_id', $id);
                });
            })->whereHas('jadwalSidang.plotJadwal', function ($query){
                $query->orderBy('tanggal', 'desc');
            })->get();
        }

        return Pdf::loadView('pdf.jadwal-proposal', ['jadwal' => $data])->setPaper('a4', 'landscape')->stream('jadwal-proposal.pdf');
    
    }

    public function index(Request $request)
    {
        $prodi = $request->query('prodi');
        $search = $request->input('search');

        $berkas = BerkasSidangProposal::where('status', 'Disetujui')->whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })->whereDoesntHave('jadwalProposals')->with('pengajuanDospem.mahasiswa')->get();

        $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })->paginate(10);

        if($search){
            $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi)->where('nama_mahasiswa', 'like', "%$search%")->orWhere('nim', 'like', "%$search%");
            })->paginate(10);
        }

        if (auth()->user()->role === 'admin') {
            return view('admin.jadwal-proposal.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'kaprodi') {
            return view('kaprodi.jadwal-proposal.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'dosen') {

            $dosenId = auth()->user()->dosen->id;

            $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi);

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }

            })->whereHas('jadwalSidang', function($query) use ($dosenId) {
                $query->where('id_penguji_1', $dosenId)->orWhere('id_penguji_2', $dosenId)->orWhere('id_pembimbing', $dosenId)->orWhereHas('jadwalProposals.berkasProposal.pengajuanDospem', function($q) use ($dosenId) {
                    $q->where('dp1_id', $dosenId)->orWhere('dp2_id', $dosenId);
                });
            })->paginate(10);

            return view('dosen.jadwal-proposal.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'mahasiswa') {

            $mahasiswaId = auth()->user()->mahasiswa->id;

            $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem', function($query) use ($mahasiswaId){
                $query->where('mahasiswa_id', $mahasiswaId);
            })->whereHas('jadwalSidang', function($query){
                $query->where('status', 'Disetujui');
            })->paginate(5);

            return view('mahasiswa.jadwal-proposal.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'berkas' => $berkas
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $sidang = JadwalSidang::find($request->id);
        $sidang->status = $request->status;
        $sidang->save();

        return redirect()->back()->withSuccess('Status jadwal sidang proposal berhasil diperbaharui');
    }

    public function updateDone(Request $request)
    {
        $sidang = JadwalSidang::find($request->id);
        $sidang->done = $request->done;
        $sidang->save();

        return redirect()->back()->withSuccess('Status sidang berhasil diperbaharui');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $prodi = $request->query('prodi');

        $berkas = BerkasSidangProposal::where('status', 'Disetujui')
        ->whereHas('pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })
        ->where(function ($query) {
            $query->whereHas('jadwalProposals.jadwalSidang', function ($query) {
                $query->where('status', 'Ditolak');
            })
            ->whereDoesntHave('jadwalProposals.jadwalSidang', function ($query) {
                $query->where('status', 'Pending')->orWhere('status', 'Disetujui');
            })
            ->orWhereDoesntHave('jadwalProposals');
        })
        ->get();

        return view('admin.jadwal-proposal.create', [
            'prodi' => $prodi,
            'berkas' => $berkas
        ]);
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

        JadwalProposal::create([
            'id_berkas_proposal' => $idBerkas,
            'id_jadwal' => $sidang->id
        ]);

        return redirect()->route('jadwal-proposal.index', ['prodi' => $request->prodi])->withSuccess('Jadwal Sidang Proposal berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalProposal $jadwalProposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalProposal $jadwalProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalProposal $jadwalProposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalProposal $jadwalProposal)
    {
        //
    }
}
