<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasSidangProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pengajuan_dospem',
        'tahun_ajaran',
        'jenis_sidang',
        'buku_bimbingan',
        'khs',
        'kst',
        'video',
        'file_dokumen',
        'status',
        'keterangan'
    ];

    public function pengajuanDospem()
    {
        return $this->belongsTo(DospemModel::class, 'id_pengajuan_dospem');
    }

    public function jadwalProposals()
    {
        return $this->hasMany(JadwalProposal::class, 'id_berkas_proposal');
    }
}
