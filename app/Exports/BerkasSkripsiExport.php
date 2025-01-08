<?php

namespace App\Exports;

use App\Models\BerkasSidangSkripsi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BerkasSkripsiExport implements FromCollection,  WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $prodi;
    private $id;


    public function __construct(string $prodi, $id)
    {
        $this->prodi = $prodi;
        $this->id = $id;
    }

    public function collection()
    {
        return BerkasSidangSkripsi::with('pengajuanDospem')
        ->whereHas('pengajuanDospem.mahasiswa', function ($query) {
            $query->where('prodi', $this->prodi);
        })->get();

    if ($this->id) {
        return BerkasSidangSkripsi::whereHas('pengajuanDospem', function ($query) {
            $query->where('dp1_id', $this->id)->orWhere('dp2_id', $this->id)->orWhereHas('berkasSkripsi.jadwalSkripsi.jadwalSidang', function ($query) {
                $query->where('id_penguji_1', $this->id)->orWhere('id_penguji_2', $this->id);
            });
        })->whereHas('pengajuanDospem.mahasiswa', function ($query) {
            $query->where('prodi', $this->prodi);
        })->get();
    }
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Nim',
            'Prodi',
            'Tahun Ajaran',
            'Dosen Pembimbing 1',
            'Dosen Pembimbing 2',
            'Judul',
            'Status',
            'Keterangan'
        ];

    }

    public function map($row): array
    {
        return [
            'No' => (string) $this->collection()->search(function ($item) use ($row) {
                return $item->id === $row->id;
            }) + 1,
            'Nama' => (string) $row->pengajuanDospem->mahasiswa->nama_mahasiswa,
            'Nim' => (string) $row->pengajuanDospem->mahasiswa->nim,
            'Prodi' => (string) $row->pengajuanDospem->mahasiswa->prodi,
            'Tahun Ajaran' => (string) $row->tahun_ajaran,
            'Dosen Pembimbing 1' => (string) $row->pengajuanDospem->dospem1->nama_dosen,
            'Dosen Pembimbing 2' => (string) $row->pengajuanDospem->dospem2 ? (string) $row->pengajuanDospem->dospem2->nama_dosen : '-',
            'Judul' => (string) $row->pengajuanDospem->judul,
            'Status' => (string) $row->status,
            'Keterangan' => (string) $row->keterangan ?? '-'
        ];
    }
}
