<?php

namespace App\Exports;

use App\Models\JadwalProposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JadwalProposalExport implements FromCollection,  WithHeadings, WithMapping
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
        $data = JadwalProposal::with('berkasProposal.pengajuanDospem')
            ->with('jadwalSidang.plotJadwal')
            ->whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) {
                $query->where('prodi', $this->prodi);
            })->get();

        if($this->id){
            $data = JadwalProposal::whereHas('berkasProposal.pengajuanDospem.mahasiswa', function ($query) {
                $query->where('prodi', $this->prodi);
            })->whereHas('jadwalSidang', function ($query) {
                $query->where('id_penguji_1', $this->id)->orWhere('id_penguji_2', $this->id)->orWhere('id_pembimbing', $this->id)->orWhereHas('jadwalProposals.berkasProposal.pengajuanDospem', function ($q) {
                    $q->where('dp1_id', $this->id)->orWhere('dp2_id', $this->id);
                });
            })->get();
        }

        return $data;
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
            'Tanggal',
            'Waktu',
            'Ruangan',
            'Link Daring',
            'Dosen Penguji 1',
            'Dosen Penguji 2',
            'Status Jadwal',
            'Status Sidang'
        ];
    }

    public function map($row): array
    {
        return [
            'No' => (string) $this->collection()->search(function ($item) use ($row) {
                return $item->id === $row->id;
            }) + 1,
            'Nama' => (string) $row->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa,
            'Nim' => (string) $row->berkasProposal->pengajuanDospem->mahasiswa->nim,
            'Prodi' => (string) $row->berkasProposal->pengajuanDospem->mahasiswa->prodi,
            'Tahun Ajaran' => (string) $row->berkasProposal->tahun_ajaran,
            'Dosen Pembimbing 1' => (string) $row->berkasProposal->pengajuanDospem->dospem1->nama_dosen,
            'Dosen Pembimbing 2' => (string) $row->berkasProposal->pengajuanDospem->dospem2->nama_dosen ?? '-',
            'Judul' => (string) $row->berkasProposal->pengajuanDospem->judul,
            'Tanggal' => (string) formatTanggalIndo($row->jadwalSidang->plotJadwal->tanggal),
            'Waktu' => (string) $row->jadwalSidang->plotJadwal->waktu . ' WIB',
            'Ruangan' => (string) $row->jadwalSidang->plotJadwal->ruangan->nama_ruangan,
            'Link Daring' => (string) $row->jadwalSidang->plotJadwal->ruangan->link_daring ?? '-',
            'Dosen Penguji 1' => (string) $row->jadwalSidang->penguji1->nama_dosen,
            'Dosen Penguji 2' => (string) $row->jadwalSidang->penguji2->nama_dosen,
            'Status Jadwal' => (string) $row->jadwalSidang->status,
            'Status Sidang' => (string) $row->jadwalSidang->done == 1 ? 'Selesai' : 'Belum Sidang',
        ];
    }
}
