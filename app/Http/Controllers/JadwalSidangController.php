<?php

namespace App\Http\Controllers;

use App\Models\BerkasSidangProposal;
use App\Models\DataTopik;
use App\Models\Dosen;
use App\Models\DospemModel;
use App\Models\JadwalProposal;
use App\Models\JadwalSidang;
use App\Models\KetersediaanDosen;
use App\Models\Mahasiswa;
use App\Models\PlotJadwal;
use App\Models\TopikDosenModel;
use App\Models\TopikModel;
use Illuminate\Http\Request;

class JadwalSidangController extends Controller
{
    public function mahasiswaInfo(Request $request)
    {
        $pengajuanDospem = DospemModel::with(['mahasiswa', 'dospem1', 'dospem2', 'berkasProposal.jadwalProposals.jadwalSidang.penguji1', 'berkasProposal.jadwalProposals.jadwalSidang.penguji2'])
            ->findOrFail($request->input('id'));

        $berkas = BerkasSidangProposal::where('id_pengajuan_dospem', $pengajuanDospem->id)->where('status', 'Disetujui')->first();

        if ($pengajuanDospem->mahasiswa->prodi != 'D3 Sistem Informasi') {
            $penguji = JadwalProposal::where('id_berkas_proposal', $berkas->id)->first();
        }

        $penguji1 = '-';
        $penguji2 = '-';

        if (isset($penguji->jadwalSidang)) {
            $penguji1 = $penguji->jadwalSidang->firstOrFail()->penguji1->nama_dosen;
            $penguji2 = $penguji->jadwalSidang->firstOrFail()->penguji2->nama_dosen;
        }

        return response()->json([
            'nim' => $pengajuanDospem->mahasiswa->nim,
            'prodi' => $pengajuanDospem->mahasiswa->prodi,
            'dospem1' => $pengajuanDospem->dospem1->nama_dosen,
            'dospem2' => $pengajuanDospem->dospem2->nama_dosen ?? '-',
            'penguji1' =>  $penguji1,
            'penguji2' => $penguji2,
            'topik' => $pengajuanDospem->topik,
            'judul' => $pengajuanDospem->judul,
        ]);
    }

    public function dospemInfo(Request $request)
    {
        $pengajuanDospem = DospemModel::with(['mahasiswa', 'dospem1', 'dospem2'])
            ->findOrFail($request->input('id'));

        return response()->json([
            'dospem1' => $pengajuanDospem->dospem1,
            'dospem2' => $pengajuanDospem->dospem2 ?? null,
        ]);
    }
    public function getPlotJadwal(Request $request)
    {
        $selectedDate = $request->input('date');
        $prodi = $request->input('prodi');
        $jenis = $request->input('jenis');

        $plotJadwal = PlotJadwal::where('tanggal', $selectedDate)->where('prodi', $prodi)->where('jenis_sidang', $jenis)->with('ruangan')->get();

        return response()->json($plotJadwal);
    }

    // Controller method to handle dynamic data
    public function getAvailableData(Request $request)
    {
        $plot = $request->query('jadwal');
        $mahasiswaId = $request->query('mahasiswaId');

        $jabatan = ["Lektor 200", "Lektor 300", "Lektor Kepala"];

        $availableDosen = KetersediaanDosen::where('id_plot_jadwal', $plot)->pluck('id_dosen');

        $pengajuanDospem = DospemModel::with(['mahasiswa', 'dospem1', 'dospem2'])->findOrFail($mahasiswaId);

        $dospem = ['dospem1' => $pengajuanDospem->dospem1, 'dospem2' => $pengajuanDospem->dospem2 ?? null];

        $dospemAvailability = [];

        $isDospem = collect([]);

        foreach ($dospem as $index => $d) {
            if($d){
                $isDospem[] = $d->id;
                $dospemAvailability[$index]['id'] = $d->id;
                $dospemAvailability[$index]['nama'] = $d->nama_dosen;
    
                if ($availableDosen->contains($d->id)) {
                    $dospemAvailability[$index]['available'] = true;
                } else {
                    $dospemAvailability[$index]['available'] = false;
                };
            }
        }

        $pengajuan = DospemModel::find($mahasiswaId);

        $peminatan = Mahasiswa::find($pengajuan->mahasiswa_id)->peminatan;

        // $topik = $pengajuan->topik; // Assuming topik is a string

        // $topikId = DataTopik::where('topik', $topik)->first();
        $peminatanTopik = DataTopik::where('peminatan', $peminatan)->pluck('id');

        $penguji1Id = TopikDosenModel::whereIn('topik_id', $peminatanTopik)->get()->unique('dosen_id');

        $penguji1 = Dosen::whereIn('id', $penguji1Id->pluck('dosen_id'))->whereIn('jabatan_fungsional', $jabatan)->pluck('id');

        $penguji1 = $penguji1->filter(function ($id) use ($isDospem) {
            return $isDospem->doesntContain($id);
        });

        $filteredPenguji1 = $penguji1->filter(function ($id) use ($availableDosen) {
            return $availableDosen->contains($id);
        });

        $penguji1fixed = Dosen::whereIn('id', $filteredPenguji1)->pluck('id', 'nama_dosen');

        return response()->json([
            'dospem' => $dospemAvailability,
            'penguji1' => $penguji1fixed
        ]);
    }

    public function getPenguji2(Request $request)
    {

        $plot = $request->query('plot');
        $mahasiswaId = $request->query('mahasiswaId');

        $jabatan = ["Lektor 200", "Lektor 300", "Asisten Ahli 150", "Lektor Kepala"];

        $availableDosen = KetersediaanDosen::where('id_plot_jadwal', $plot)->pluck('id_dosen');

        $pengajuanDospem = DospemModel::find($mahasiswaId);

        $penguji1 = Dosen::find($request->query('penguji1'));

        $dosenException = collect([$pengajuanDospem->dp1_id, $pengajuanDospem->dp2_id, $penguji1->id]);

        $penguji2 = $availableDosen->filter(function ($id) use ($dosenException) {
            return $dosenException->doesntContain($id);
        });

        $penguji2fixed = Dosen::whereIn('id', $penguji2)->whereIn('jabatan_fungsional', $jabatan)->pluck('id', 'nama_dosen');

        return response()->json($penguji2fixed);
    }


    public function updateDone(Request $request)
    {
        $sidang = JadwalSidang::find($request->id);
        $sidang->done = $request->done;
        $sidang->save();

        return redirect()->back()->withSuccess('Status sidang berhasil diperbaharui');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalSidang $jadwalSidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalSidang $jadwalSidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalSidang $jadwalSidang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalSidang $jadwalSidang)
    {
        //
    }
}
