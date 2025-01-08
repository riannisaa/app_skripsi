<?php

namespace App\Exports;

use App\Models\JadwalProposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HasilProposalExport implements FromCollection,  WithHeadings, WithMapping
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
            'Dosen Pembimbing 1',
            'Dosen Pembimbing 2',
            'Judul',
            'Tanggal',
            'Waktu',
            'Ruangan',
            'Dosen Penguji 1',
            'Dosen Penguji 2',
            'Status Sidang',
            'Nilai Akhir'
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
            'Dosen Pembimbing 1' => (string) $row->berkasProposal->pengajuanDospem->dospem1->nama_dosen,
            'Dosen Pembimbing 2' => (string) $row->berkasProposal->pengajuanDospem->dospem2->nama_dosen ?? '-',
            'Judul' => (string) $row->berkasProposal->pengajuanDospem->judul,
            'Tanggal' => (string) formatTanggalIndo($row->jadwalSidang->plotJadwal->tanggal),
            'Waktu' => (string) $row->jadwalSidang->plotJadwal->waktu . ' WIB',
            'Ruangan' => (string) $row->jadwalSidang->plotJadwal->ruangan->nama_ruangan,
            'Dosen Penguji 1' => (string) $row->jadwalSidang->penguji1->nama_dosen,
            'Dosen Penguji 2' => (string) $row->jadwalSidang->penguji2->nama_dosen,
            'Status Sidang' => (string) $row->jadwalSidang->done == 1 ? 'Selesai' : 'Belum Sidang',
            'Nilai Akhir' => (string) $this->finalScore($row)
        ];
    }

    public function finalScore($row)
    {
        if(count($row->hasilProposal) == 3){
            $pembimbingId = $row->jadwalSidang->id_pembimbing;
            $penguji1Id = $row->jadwalSidang->id_penguji_1;
            $penguji2Id = $row->jadwalSidang->id_penguji_2;

            $pembimbingScore = 0;
            $penguji1Score = 0;
            $penguji2Score = 0;

            foreach($row->hasilProposal as $p){
            if($p->id_dosen == $pembimbingId){
            $pembimbingScore = $pembimbingScore + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
            }elseif($p->id_dosen == $penguji1Id){
            $penguji1Score = $penguji1Score + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
            }elseif($p->id_dosen == $penguji2Id){
            $penguji2Score = $penguji2Score + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
            }
            }

            $nilai_akhir = ($pembimbingScore*0.5) + ($penguji1Score*0.25) + ($penguji2Score*0.25);

            switch($nilai_akhir){
            case $nilai_akhir >= 85:
            return "A";
            break;
            case $nilai_akhir >= 80:
            return "A-";
            break;
            case $nilai_akhir >= 75:
            return "B+";
            break;
            case $nilai_akhir >= 70:
            return "B";
            break;
            case $nilai_akhir >= 65:
            return "B-";
            break;
            case $nilai_akhir >= 60:
            return "C+";
            break;
            case $nilai_akhir >= 55:
            return "C";
            break;
            case $nilai_akhir >= 40:
            return "D";
            break;
            case $nilai_akhir >= 1:
            return "E";
            }

            }else{
            return 'Belum Lengkap';
            }
    }
}
