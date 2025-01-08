<?php

namespace App\Http\Controllers;

use App\Exports\HasilProposalExport;
use App\Models\Dosen;
use App\Models\FormStatus;
use App\Models\HasilProposal;
use App\Models\JadwalProposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class HasilProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function export(Request $request)
    {
        $prodi = $request->query('prodi');
        $id = $request->query('id') ?? null;

        return Excel::download(new HasilProposalExport($prodi, $id), 'hasil-proposal.xlsx');
    }

    public function index(Request $request)
    {
        $prodi = $request->query('prodi');
        $search = $request->input('search');

        if (auth()->user()->role === 'dosen') {

            $dosenId = auth()->user()->dosen->id;

            $jadwal = JadwalProposal::whereHas('jadwalSidang', function ($query) use ($dosenId) {
                $query->where('id_penguji_1', $dosenId)->orWhere('id_penguji_2', $dosenId)->orWhere('id_pembimbing', $dosenId);
                $query->where('done', true);
            })->whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
                $query->where('prodi', $prodi);

                if ($search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('nama_mahasiswa', 'like', "%$search%")
                            ->orWhere('nim', 'like', "%$search%");
                    });
                }
            })->paginate(10);

            $formStatus = FormStatus::where('form_id', 'nilai_proposal')->first();

            if ($formStatus->accepting_responses === 0) {
                $isButtonDisabled = true;
                return view('dosen.hasil-proposal.index', [
                    'message' => 'Form penilaian sidang proposal telah ditutup',
                    'isButtonDisabled' => $isButtonDisabled,
                    'prodi' => $prodi
                ]);
            }

            return view('dosen.hasil-proposal.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'mahasiswa') {

            $mahasiswaId = auth()->user()->mahasiswa->id;

            $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem', function ($query) use ($mahasiswaId) {
                $query->where('mahasiswa_id', $mahasiswaId);
            })->whereHas('hasilProposal')->paginate(5);

            return view('mahasiswa.hasil-proposal.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi
            ]);
        }

        if (auth()->user()->role === 'kaprodi') {

            $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
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

            return view('kaprodi.hasil-proposal.index', [
                'jadwal' => $jadwal,
                'prodi' => $prodi,
                'search' => $search
            ]);
        }

        if (auth()->user()->role === 'admin') {
            $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi, $search) {
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

            return view('admin.hasil-proposal.index', [
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

        $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
            $query->where('prodi', $prodi);
        })->get();

        if (auth()->user()->role === 'dosen') {
            $dosenId = auth()->user()->dosen->id;

            $jadwal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) use ($prodi) {
                $query->where('prodi', $prodi);
            })->whereHas('jadwalSidang', function ($query) use ($dosenId) {
                $query->where('id_penguji_1', $dosenId)->orWhere('id_penguji_2', $dosenId)->orWhere('id_pembimbing', $dosenId);
                $query->where('done', true);
            })->get();
        }

        $zip = new ZipArchive();
        $timestamp = now()->format('YmdHis');
        $zipFileName = "hasil-proposal-$timestamp.zip";
        $zipFilePath = storage_path("app/$zipFileName");

        if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
            return response()->json(['message' => 'Could not create ZIP file'], 500);
        }
        
        if(!count($jadwal)){
            return redirect()->back();
        }

        foreach ($jadwal as $d) {
            $nama = $d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa;
            $pdfContent = Pdf::loadView('pdf.hasil-proposal', ['d' => $d])->output();
            $pdfFileName = "hasil-proposal-$nama-$timestamp.pdf";
    
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
        $idProposal = $request->query('id');
        $idDosen = $request->query('dosen');
        $prodi = $request->query('prodi');

        $proposal = JadwalProposal::find($idProposal);
        $dosen = Dosen::find($idDosen);

        if ($proposal->jadwalSidang->id_pembimbing == $dosen->id) {
            $status = 'Dosen Pembimbing';
        } elseif ($proposal->jadwalSidang->id_penguji_1 == $dosen->id) {
            $status = 'Dosen Penguji 1';
        } elseif ($proposal->jadwalSidang->id_penguji_2 == $dosen->id) {
            $status = 'Dosen Penguji 2';
        }

        return view('dosen.hasil-proposal.create', [
            'proposal' => $proposal,
            'dosen' => $dosen,
            'status' => $status,
            'prodi' => $prodi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        HasilProposal::create($request->all());
        return redirect()->route('hasil-proposal.index', ['prodi' => $request->prodi])->withSuccess('Berhasil memberikan penilaian');
    }

    /**
     * Display the specified resource.
     */
    public function show(HasilProposal $hasilProposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilProposal $hasilProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HasilProposal $hasilProposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilProposal $hasilProposal)
    {
        //
    }
}
