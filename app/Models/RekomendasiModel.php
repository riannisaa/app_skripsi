<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiModel extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_akademik';
    protected $primaryKey = 'id';
    protected $fillable = ['mahasiswa_id', 'dosenpa_id', 'sks', 'khs_file', 'pkm_file', 'toefl_file', 'ukt_file', 'seminar_file', 'profesi_file', 'status', 'ket','tanggal_pengajuan'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

}
