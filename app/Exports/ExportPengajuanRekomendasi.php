<?php

namespace App\Exports;

use App\Models\RekomendasiModel;
use App\Models\TopikModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExportPengajuanRekomendasi implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return RekomendasiModel::query()
        ->join('mahasiswa', 'rekomendasi_akademik.mahasiswa_id', '=', 'mahasiswa.id')
        ->join('dosen', 'mahasiswa.dosenpa_id', '=', 'dosen.id')
            ->select(
                'rekomendasi_akademik.*', 
                'mahasiswa.*',
                'dosen.*'
            );
    }

    public function headings(): array
    {
        return [
            'no',
            'tanggal',
            'nama_mahasiswa',
            'nim',
            'prodi',
            'dosen PA',
            'status',
        ];

    }

    private $counter = 1;

    public function map($row): array
    {

        return [
            'no' => $this->counter++,
            'tanggal' => $row->tanggal_pengajuan,            
            'nama' => (string) $row->nama_mahasiswa,
            'nim' => (string) $row->nim,
            'prodi' => (string) $row->prodi,
            'dosen PA' => (string) $row->nama_dosen,
            'status' => (string) $row->status,
        ];
    }
}
