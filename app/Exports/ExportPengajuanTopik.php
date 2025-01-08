<?php

namespace App\Exports;

use App\Models\TopikModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExportPengajuanTopik implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return TopikModel::query()
            ->join('mahasiswa', 'pengajuan_topik.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('data_topik', 'pengajuan_topik.topik_id', '=', 'data_topik.id')
            ->select(
                'pengajuan_topik.*',
                'mahasiswa.*',
                'data_topik.topik' 
            );
    }

    public function headings(): array
    {
        return [
            'no',
            'nama_mahasiswa',
            'nim',
            'prodi',
            'peminatan',
            'topik',
            'judul',
            'desc_judul',
            'status',
            'desc_status'
        ];

    }

    private $counter = 1;

    public function map($row): array
    {

        return [
            'no' => $this->counter++,
            'nama' => (string) $row->nama_mahasiswa,
            'nim' => (string) $row->nim,
            'prodi' => (string) $row->prodi,
            'peminatan' => (string) $row->peminatan,
            'topik' => (string) $row->topik,
            'judul' => (string) $row->judul,
            'desc_judul' => (string) $row->desc_judul,
            'status' => (string) $row->status,
            'desc_status' => (string) $row->desc_status
        ];
    }
}
