<?php

namespace App\Http\Controllers;

use App\Models\KetersediaanDosen;
use App\Models\PlotJadwal;
use App\Models\Ruangan;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlotJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prodi = $request->query('prodi');
        $dailyMax = SiteSetting::where('name', 'dailyMax')->first();

        $jadwal = PlotJadwal::where('prodi', $prodi)->orderBy('tanggal', 'asc')->get();
        $ketersediaan = KetersediaanDosen::whereHas('plotJadwal', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })->get();

        // dd($jadwal);

        return view('admin.plot-jadwal.index', ['prodi' => $prodi, 'dailyMax' => $dailyMax, 'jadwal' =>$jadwal, 'ketersediaan' => $ketersediaan]);
    }

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
        $validatedData = $request->validate([
            'prodi' => 'required|string|max:35',
            'jenis_sidang' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'id_ruangan' => 'required|exists:ruangans,id',
        ]);

        $tanggal = $validatedData['tanggal'];
        $waktuMulai = $validatedData['waktu_mulai'];
        $waktuSelesai = $validatedData['waktu_selesai'];
        $idRuangan = $validatedData['id_ruangan'];

        $requestedTimeRange = $waktuMulai . " - " . $waktuSelesai;
        $requestedStartTime = strtotime($waktuMulai);
        $requestedEndTime = strtotime($waktuSelesai);

        $conflictingSchedules = PlotJadwal::where('tanggal', $tanggal)
            ->where('id_ruangan', $idRuangan)
            ->get();

        foreach ($conflictingSchedules as $schedule) {
            [$startTime, $endTime] = explode(" - ", $schedule->waktu);
            $scheduleStart = strtotime($startTime);
            $scheduleEnd = strtotime($endTime);

            if ($requestedStartTime < $scheduleEnd && $requestedEndTime > $scheduleStart) {
                return redirect()->back()->withErrors(['message' => 'Jadwal bertabrakan pada ruang yang dipilih.'])->withInput();
            }
        }

        // Create a new PlotJadwal record
        PlotJadwal::create([
            'id_ruangan' => $idRuangan,
            'waktu' => $requestedTimeRange,
            'tanggal' => $tanggal,
            'prodi' => $validatedData['prodi'],
            'jenis_sidang' => $validatedData['jenis_sidang'],
        ]);

        // Redirect or respond with success message
        return redirect()->back()->with('success', 'Berhasil membuat plot jadwal.');
    }

    public function checkRuang(Request $request)
    {
        $tanggal = $request->query('tanggal');
        $waktuMulai = $request->query('waktu_mulai');
        $waktuSelesai = $request->query('waktu_selesai');

        // Prepare the time range to compare
        $requestedTimeRange = $waktuMulai . " - " . $waktuSelesai;

        // Convert time to a comparable format
        [$requestedStartTime, $requestedEndTime] = [
            strtotime($waktuMulai),
            strtotime($waktuSelesai)
        ];

        // Get all schedules for the specified date
        $schedules = PlotJadwal::where('tanggal', $tanggal)->get();

        // Filter out conflicting schedules
        $conflictingRooms = $schedules->filter(function ($schedule) use ($requestedStartTime, $requestedEndTime) {
            [$startTime, $endTime] = explode(" - ", $schedule->waktu);
            $scheduleStart = strtotime($startTime);
            $scheduleEnd = strtotime($endTime);

            // Check if there is an overlap
            return ($requestedStartTime < $scheduleEnd && $requestedEndTime > $scheduleStart);
        });

        // Get the IDs of the conflicting rooms
        $conflictingRoomIds = $conflictingRooms->pluck('id_ruangan')->unique();

        // Fetch the room details that are not conflicting
        $availableRooms = Ruangan::whereNotIn('id', $conflictingRoomIds)->get();

        // Return the available rooms as JSON
        return response()->json($availableRooms);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlotJadwal $plotJadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlotJadwal $plotJadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlotJadwal $plotJadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlotJadwal $plotJadwal)
    {
        $plotJadwal->delete();

        return redirect()->back()->with('success', 'Plot jadwal berhasil dihapus.');
    }
}
