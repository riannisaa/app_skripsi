<?php

namespace App\Http\Controllers;

use App\Models\KetersediaanDosen;
use App\Models\PlotJadwal;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KetersediaanDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = auth()->user()->dosen;

        $ketersediaan = KetersediaanDosen::where('id_dosen', $dosen->id)->get();

        return view('dosen.ketersediaan.index', ['ketersediaan' => $ketersediaan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plotJadwal = PlotJadwal::orderBy('tanggal', 'asc')->get();

        return view('dosen.ketersediaan.create', ['plotJadwal' => $plotJadwal]);
    }

    public function filterTanggal(Request $request)
    {
        $prodi = $request->query('prodi');
        $jenisSidang = $request->query('jenis_sidang');

        $plotJadwals = PlotJadwal::where('prodi', $prodi)
            ->where('jenis_sidang', $jenisSidang)
            ->pluck('tanggal');

        return response()->json([
            'availableDate' => $plotJadwals,
        ]);
    }

    public function filterJadwal(Request $request)
    {
        $prodi = $request->input('prodi');
        $jenisSidang = $request->input('jenis_sidang');
        $tanggal = $request->input('tanggal');
        $idDosen = auth()->user()->dosen->id;
        $selectedWaktu = $request->input('waktu', []);

        // Retrieve the daily max limit from the SiteSettings model
        $dailyMax = SiteSetting::where('name', 'dailyMax')->value('value');

        // Retrieve all schedules for the specified prodi, jenis_sidang, and tanggal
        $plotJadwals = PlotJadwal::where('prodi', $prodi)
            ->where('jenis_sidang', $jenisSidang)
            ->where('tanggal', $tanggal)
            ->with(['ketersediaanDosens' => function ($query) use ($idDosen) {
                $query->where('id_dosen', $idDosen);
            }])
            ->get();

        $availableTimes = [];

        // Retrieve all schedules for the specified tanggal to check for overlaps
        $allSchedulesForDate = PlotJadwal::where('tanggal', $tanggal)->whereHas('ketersediaanDosens', function ($query) use ($idDosen) {
            $query->where('id_dosen', $idDosen);
        })->get();

        // Retrieve all ketersediaan_dosens for the current dosen to count filled schedules
        $filledSchedulesCount = KetersediaanDosen::where('id_dosen', $idDosen)
            ->whereHas('plotJadwal', function ($query) use ($tanggal) {
                $query->where('tanggal', $tanggal);
            })
            ->count();

        foreach ($plotJadwals as $plotJadwal) {
            $plotJadwalWaktu = explode(' - ', $plotJadwal->waktu);
            $startWaktu = Carbon::createFromFormat('H:i', $plotJadwalWaktu[0]);
            $endWaktu = Carbon::createFromFormat('H:i', $plotJadwalWaktu[1]);

            $isUsed = false;
            $isFilled = $plotJadwal->ketersediaanDosens->isNotEmpty();

            // Check for overlapping time slots across all schedules for the same date
            foreach ($allSchedulesForDate as $otherPlotJadwal) {
                if ($plotJadwal->id !== $otherPlotJadwal->id) {
                    $otherWaktu = explode(' - ', $otherPlotJadwal->waktu);
                    $otherStartWaktu = Carbon::createFromFormat('H:i', $otherWaktu[0]);
                    $otherEndWaktu = Carbon::createFromFormat('H:i', $otherWaktu[1]);

                    // Check for overlapping time slots
                    if ($startWaktu->lt($otherEndWaktu) && $endWaktu->gt($otherStartWaktu)) {
                        $isUsed = true;
                        break;
                    }
                }
            }

            $availableTimes[] = [
                'id' => $plotJadwal->id,
                'waktu' => $plotJadwal->waktu,
                'ruangan' => $plotJadwal->ruangan->nama_ruangan,
                'used' => $isFilled || $isUsed
            ];
        }

        // Check if the dosen has reached the dailyMax limit
        $limitReached = $filledSchedulesCount >= $dailyMax;

        return response()->json([
            'availableTimes' => $availableTimes,
            'limitReached' => $limitReached
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_dosen = auth()->user()->dosen->id;

        $prodi = $request->input('prodi');
        $jenis_sidang = $request->input('jenis_sidang');
        $tanggal = $request->input('tanggal');
        $waktu = $request->input('waktu');

        foreach ($waktu as $waktuId) {
            $plotJadwal = PlotJadwal::where('prodi', $prodi)
                ->where('jenis_sidang', $jenis_sidang)
                ->where('tanggal', $tanggal)
                ->where('id', $waktuId)
                ->first();

            if ($plotJadwal) {
                KetersediaanDosen::create([
                    'id_plot_jadwal' => $plotJadwal->id,
                    'id_dosen' => $id_dosen,
                    'used' => 0,
                ]);
            }
        }

        // Redirect back with a success message
        return redirect()->route('ketersediaan.index')->with('success', 'Input ketersediaan jadwal sidang berhasil dilakukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KetersediaanDosen $ketersediaanDosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KetersediaanDosen $ketersediaanDosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KetersediaanDosen $ketersediaanDosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KetersediaanDosen::find($id)->delete();

        return redirect()->back()->with('success', 'Ketersediaan jadwal berhasil dihapus.');
    }
}
