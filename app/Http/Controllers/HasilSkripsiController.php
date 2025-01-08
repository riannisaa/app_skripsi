<?php

namespace App\Http\Controllers;

use App\Exports\HasilSkripsiExport;
use App\Models\FormStatus;
use App\Models\HasilSkripsiPembimbing;
use App\Models\HasilSkripsiPenguji;
use App\Models\JadwalSkripsi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class HasilSkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function export(Request $request)
    {
        $prodi = $request->query('prodi');
        $id = $request->query('id') ?? null;

        return Excel::download(new HasilSkripsiExport($prodi, $id), 'hasil-skripsi.xlsx');
    }

    public function index(Request $request)
    {
        $prodi = $request->query('prodi');
        $search = $request->query('search') ?? null;

        if (auth()->user()->role === 'dosen') {

            $dosenId = auth()->user()->dosen->id;

            $jadwal = JadwalSkripsi::whereHas('jadwalSidang', function ($query) use ($dosenId) {
                $query->where('id_pembimbing', $dosenId)->orWhere('id_penguji_1', $dosenId)->orWhere('id_penguji_2', $dosenId);
                $query->orWhereHas('jadwalSkripsi.berkasSkripsi.pengajuanDospem', function ($query) use ($dosenId) {
                    $query->orWhere('dp2_id', $dosenId);
                });
                $query->where('done', true);
            })->whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi);

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })->paginate(10);

            $formStatus = FormStatus::where('form_id', 'nilai_skripsi')->first();

            if ($formStatus->accepting_responses === 0) {
                $isButtonDisabled = true;
                return view('dosen.hasil-skripsi.index', [
                    'message' => 'Form penilaian sidang skripsi telah ditutup',
                    'isButtonDisabled' => $isButtonDisabled,
                    'prodi' => $prodi
                ]);
            }

            return view('dosen.hasil-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'mahasiswa') {

            $mahasiswaId = auth()->user()->mahasiswa->id;

            $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem', function ($query) use ($mahasiswaId) {
                $query->where('mahasiswa_id', $mahasiswaId);
            })->paginate(5);

            return view('mahasiswa.hasil-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi
            ]);
        }

        if (auth()->user()->role === 'kaprodi') {
            $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi);

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })
                ->whereHas('jadwalSidang', function ($query) {
                    $query->where('status', 'Disetujui')->orWhere('status', 'Pending');
                })
                ->paginate(15);

            return view('kaprodi.hasil-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'admin') {
            $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi);

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })
                ->whereHas('jadwalSidang', function ($query) {
                    $query->where('status', 'Disetujui')->orWhere('status', 'Pending');
                })
                ->paginate(15);

            return view('admin.hasil-skripsi.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'search' => $search
            ]);
        }
    }


    public function massExport(Request $request)
    {
        $prodi = $request->query('prodi');
        $timestamp = Carbon::now()->timestamp;

        $jadwal = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })->get();

        if (auth()->user()->role === 'dosen') {
            $dosenId = auth()->user()->dosen->id;

            $jadwal = JadwalSkripsi::whereHas('jadwalSidang', function ($query) use ($dosenId) {
                $query->where('id_penguji_1', $dosenId)->orWhere('id_penguji_2', $dosenId);
                $query->where('done', true);
            })->orWhereHas('berkasSkripsi.pengajuanDospem', function ($query) use ($dosenId) {
                $query->where('dp1_id', $dosenId)->orWhere('dp2_id', $dosenId);
            })->whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
                $query->where('prodi', $prodi);
            })->get();
        }

        $zip = new ZipArchive();
        $timestamp = now()->format('YmdHis');
        $zipFileName = "hasil-skripsi-$timestamp.zip";
        $zipFilePath = storage_path("app/$zipFileName");

        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
            return response()->json(['message' => 'Could not create ZIP file'], 500);
        }

        if (!count($jadwal)) {
            return redirect()->back();
        }

        foreach ($jadwal as $d) {
            $nama = $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa;
            $pdfContent = Pdf::loadView('pdf.hasil-skripsi', ['d' => $d])->output();
            $pdfFileName = "hasil-skripsi-$nama-$timestamp.pdf";

            // Add the PDF content to the ZIP file
            $zip->addFromString($pdfFileName, $pdfContent);
        }

        $zip->close();

        // Return the ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $dosenId = auth()->user()->dosen->id;
        $idJadwal = $request->query('id');
        $prodi = $request->query('prodi');

        $jadwal = JadwalSkripsi::where('id', $idJadwal)->first();

        if ($jadwal->jadwalSidang->id_penguji_1 == $dosenId || $jadwal->jadwalSidang->id_penguji_2 == $dosenId) {
            return view('dosen.hasil-skripsi.create-penguji', [
                'jadwal' => $jadwal,
                'prodi' => $prodi
            ]);
        } elseif ($jadwal->jadwalSidang->id_pembimbing == $dosenId) {
            return view('dosen.hasil-skripsi.create-pembimbing', [
                'jadwal' => $jadwal,
                'prodi' => $prodi
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->query('status') == 'penguji') {
            HasilSkripsiPenguji::create($request->all());
        } elseif ($request->query('status') == 'pembimbing') {
            HasilSkripsiPembimbing::create($request->all());
        }

        return redirect()->route('hasil-skripsi.index', ['prodi' => $request->prodi])->withSuccess('Berhasil memberikan nilai akhir skripsi');
    }

    /**
     * Display the specified resource.
     */
    public function show(HasilSkripsiPembimbing $hasilSkripsiPembimbing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
