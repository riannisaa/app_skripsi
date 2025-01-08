<?php

namespace App\Exports;

use App\Models\DospemModel;
use App\Models\TopikModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExportPengajuanDospem implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return DospemModel::query()
            ->join('mahasiswa', 'pengajuan_dospem.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('dosen as dp1', 'dp1.id', '=', 'pengajuan_dospem.dp1_id')
            ->leftJoin('dosen as dp2', 'dp2.id', '=', 'pengajuan_dospem.dp2_id')
            ->select(
                'pengajuan_dospem.*',
                'mahasiswa.nama_mahasiswa',
                'mahasiswa.nim',
                'mahasiswa.prodi',
                'dp1.nama_dosen as nama_dp1',
                'dp2.nama_dosen as nama_dp2'
            );
    }

    public function headings(): array
    {
        return [
            'no',
            'nama mahasiswa',
            'nim',
            'prodi',
            'dosen pembimbing 1',
            'dosen pembimbing 2',
            'topik',
            'judul',
            'status',
            'ket'
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
            'dosen pembimbing 1' => (string) $row->nama_dp1,
            'dosen pembimbing 2' => (string) $row->nama_dp2,
            'topik' => (string) $row->topik,
            'judul' => (string) $row->judul,
            'status' => (string) $row->status,
            'ket' => (string) $row->desc_status
        ];
    }
}
