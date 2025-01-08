<?php

namespace App\Exports;

use App\Models\DataTopik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class ExportListTopik implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return DataTopik::all();

    }


    public function headings(): array
    {
        // Define your column headers
        return [
            'no',
            'jurusan',
            'peminatan',
            'topik',
            'ket',
            'kapasitas',
            'peserta',
        ];
    }

    public function map($row): array
    {
        return [
            'no' => (string) $row->id,
            'jurusan' => (string) $row->jurusan,
            'peminatan' => (string) $row->peminatan,
            'topik' => (string) $row->topik,
            'ket' => (string) $row->ket,
            'kapasitas' => (string) $row->kapasitas,
            'peserta' => (string) $row->peserta,
        ];
    }
}
