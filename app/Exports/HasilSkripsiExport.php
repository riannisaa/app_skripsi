<?php

namespace App\Exports;

use App\Models\JadwalSkripsi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HasilSkripsiExport implements FromCollection,  WithHeadings, WithMapping
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
        $data = JadwalSkripsi::with('berkasSkripsi.pengajuanDospem')
            ->with('jadwalSidang.plotJadwal')
            ->whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) {
                $query->where('prodi', $this->prodi);
            })->get();

        if ($this->id) {
            $data = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem.mahasiswa', function ($query) {
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
            'Dosen Pembimbing 1',
            'Dosen Pembimbing 2',
            'Judul',
            'Tanggal',
            'Waktu',
            'Ruangan',
            'Dosen Penguji 1',
            'Dosen Penguji 2',
            'Status Sidang',
            'Keterangan',
            'Nilai Akhir'
        ];
    }

    public function map($row): array
    {
        return [
            'No' => (string) $this->collection()->search(function ($item) use ($row) {
                return $item->id === $row->id;
            }) + 1,
            'Nama' => (string) $row->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa,
            'Nim' => (string) $row->berkasSkripsi->pengajuanDospem->mahasiswa->nim,
            'Prodi' => (string) $row->berkasSkripsi->pengajuanDospem->mahasiswa->prodi,
            'Dosen Pembimbing 1' => (string) $row->berkasSkripsi->pengajuanDospem->dospem1->nama_dosen,
            'Dosen Pembimbing 2' => (string) $row->berkasSkripsi->pengajuanDospem->dospem2 ? (string) $row->berkasSkripsi->pengajuanDospem->dospem2->nama_dosen : '-',
            'Judul' => (string) $row->berkasSkripsi->pengajuanDospem->judul,
            'Tanggal' => (string) formatTanggalIndo($row->jadwalSidang->plotJadwal->tanggal),
            'Waktu' => (string) $row->jadwalSidang->plotJadwal->waktu . ' WIB',
            'Ruangan' => (string) $row->jadwalSidang->plotJadwal->ruangan->nama_ruangan,
            'Dosen Penguji 1' => (string) $row->jadwalSidang->penguji1->nama_dosen,
            'Dosen Penguji 2' => (string) $row->jadwalSidang->penguji2->nama_dosen,
            'Status Sidang' => (string) $row->jadwalSidang->done == 1 ? 'Selesai' : 'Belum Sidang',
            'Keterangan' => (string) $row->status_revisi,
            'Nilai Akhir' => (string) $this->finalScore($row)
        ];
    }

    public function finalScore($row)
    {
        $hasilPembimbing = $row->hasilSkripsiPembimbing;
        $hasilPenguji = $row->hasilSkripsiPenguji;

        if (count($hasilPembimbing) > 0 && count($hasilPenguji) > 1) {
            $nilai_pembimbing = 0;
            foreach ($hasilPembimbing as $p) {
                $nilai_pembimbing = $nilai_pembimbing +
                    $p->kedisiplinan +
                    $p->kemauan +
                    $p->kemandirian +
                    $p->standarisasi +
                    $p->keutuhan +
                    $p->kerapihan +
                    $p->analisis +
                    $p->solusi +
                    $p->kajian +
                    $p->penguasaan;
            }

            $nilai_pembimbing = $nilai_pembimbing * 0.5;

            $nilai_penguji = 0;
            foreach ($hasilPenguji as $p) {
                $nilai = 0;
                $nilai = $nilai +
                    $p->sarana +
                    $p->menjelaskan +
                    $p->standarisasi +
                    $p->keutuhan +
                    $p->kerapihan +
                    $p->pemahaman +
                    $p->pendekatan +
                    $p->menjawab;

                $nilai = $nilai * 0.25;
                $nilai_penguji = $nilai_penguji + $nilai;
            }

            $nilai_akhir = $nilai_pembimbing + $nilai_penguji;

            switch ($nilai_akhir) {
                case $nilai_akhir >= 85:
                    return ("A");
                    break;
                case $nilai_akhir >= 80:
                    return ("A-");
                    break;
                case $nilai_akhir >= 75:
                    return ("B+");
                    break;
                case $nilai_akhir >= 70:
                    return ("B");
                    break;
                case $nilai_akhir >= 65:
                    return ("B-");
                    break;
                case $nilai_akhir >= 60:
                    return ("C+");
                    break;
                case $nilai_akhir >= 55:
                    return ("C");
                    break;
                case $nilai_akhir >= 40:
                    return ("D");
                    break;
                case $nilai_akhir >= 1:
                    return ("E");
            }
        }
    }
}
