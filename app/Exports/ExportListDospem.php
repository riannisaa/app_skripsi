<?php

namespace App\Exports;

use App\Models\Dosen;
use App\Models\DospemModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportListDospem implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dosen::with('topik:topik')->get(['id','nama_dosen', 'nip', 'kapasitas_dp1', 'peserta_dp1', 'kapasitas_dp2', 'peserta_dp2']);
    }

    public function headings(): array
    {
        return [
            'no',
            'nama',
            'nip',
            'topik',
            'kap. 1',
            'peserta 1',
            'kap. 2',
            'peserta 2'
        ];

    }

    public function map($row): array
    {
        $topikNames = $row->topik->pluck('topik')->implode(', ');

        return [
            'no' => (string) $row->id,
            'nama' => (string) $row->nama_dosen,
            'nip' => (string) $row->nip,
            // 'topik' => (string) $row->topik,
            'topik' => $topikNames,
            'kap. 1' => (string) $row->kapasitas_dp1,
            'peserta 1' => (string) $row->peserta_dp1,
            'kap. 2' => (string) $row->kapasitas_dp2,
            'peserta 2' => (string) $row->peserta_dp2,
        ];
    }
}
