<?php

namespace App\Exports;

use App\Models\Dosen;
use App\Models\RekomendasiModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPengajuanRekomendasiDosen implements FromQuery, WithHeadings, WithMapping
{
    // public function query()
    // {
        
    //     $user = auth()->user();
    //     $dosen = Dosen::where('user_id', $user->id)->first();
    //     $dosen_id = $dosen->id;

    //     return RekomendasiModel::query()
    //     ->join('mahasiswa', 'rekomendasi_akademik.mahasiswa_id', '=', 'mahasiswa.id')
    //     ->join('dosen', 'mahasiswa.dosenpa_id', '=', 'dosen.id')
    //     ->where('rekomendasi_akademik.dosenpa_id', $dosen_id)
    //         ->select(
    //             'rekomendasi_akademik.*', 
    //             'mahasiswa.*',
    //             'dosen.*'
    //         );
    // }

    public function query()
{
    $user = auth()->user();
    $dosen = Dosen::where('user_id', $user->id)->first();
    $dosen_id = $dosen->id;

    return RekomendasiModel::query()
        ->join('mahasiswa', 'rekomendasi_akademik.mahasiswa_id', '=', 'mahasiswa.id')
        ->select(
            'rekomendasi_akademik.id',
            'rekomendasi_akademik.tanggal_pengajuan',
            // 'rekomendasi_akademik.sks',
            // 'rekomendasi_akademik.khs_file',
            // 'rekomendasi_akademik.toefl_file',
            // 'rekomendasi_akademik.ukt_file',
            // 'rekomendasi_akademik.pkm_file',
            // 'rekomendasi_akademik.seminar_file',
            // 'rekomendasi_akademik.profesi_file',
            'rekomendasi_akademik.status',
            'rekomendasi_akademik.ket',
            'mahasiswa.nama_mahasiswa',
            'mahasiswa.nim',
            'mahasiswa.prodi'
        )
        ->where('rekomendasi_akademik.dosenpa_id', $dosen_id);
}


    public function headings(): array
    {
        return [
            'no',
            'tanggal',
            'nama_mahasiswa',
            'nim',
            'prodi',
            'status',
            'ket',
        ];

    }

    private $counter = 1;

    public function map($row): array
    {
        return [
            'no' => $this->counter++,
            'tanggal' => $row->tanggal_pengajuan,            
            'nama_mahasiswa' => (string) $row->nama_mahasiswa,
            'nim' => (string) $row->nim,
            'prodi' => (string) $row->prodi,
            'status' => (string) $row->status,
            'ket' => (string) $row->ket,

        ];
    }
}
