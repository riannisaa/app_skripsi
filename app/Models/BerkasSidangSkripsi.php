<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasSidangSkripsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pengajuan_dospem',
        'tahun_ajaran',
        'ktp_kk_akta',
        'pas_foto',
        'ijazah',
        'buku_bimbingan',
        'turnitin',
        'khs',
        'kst',
        'ukt',
        'file_dokumen',
        'video',
        'status',
        'keterangan',
    ];

    public function pengajuanDospem()
    {
        return $this->belongsTo(DospemModel::class, 'id_pengajuan_dospem');
    }

    public function jadwalSkripsi()
    {
        return $this->hasMany(JadwalSkripsi::class, 'id_berkas_skripsi');
    }
}
