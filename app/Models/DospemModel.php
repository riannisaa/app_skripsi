<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DospemModel extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_dospem';
    protected $primaryKey = 'id';
    protected $fillable = ['mahasiswa_id', 'topik', 'judul', 'dp1_id', 'dp2_id', 'status', 'desc_status','periode','semester'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dospem1()
    {
        return $this->belongsTo(Dosen::class, 'dp1_id');
    }
    public function dospem2()
    {
        return $this->belongsTo(Dosen::class, 'dp2_id');
    }
    public function berkasProposal()
    {
        return $this->hasMany(BerkasSidangProposal::class, 'id_pengajuan_dospem');
    }

    public function berkasSkripsi()
    {
        return $this->hasMany(BerkasSidangSkripsi::class, 'id_pengajuan_dospem');
    }

}