<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'nama_dosen', 'nip', 'keahlian', 'kapasitas_dp1', 'peserta_dp1', 'kapasitas_dp2', 'peserta_dp2', 'jabatan_fungsional' ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id', 'dosenpa_id');
    }

    public function topik()
    {
        return $this->belongsToMany(DataTopik::class, 'topik_dosen', 'dosen_id', 'topik_id');
    }

    public function hasilProposal()
    {
        return $this->hasMany(HasilProposal::class, 'id_dosen');
    }

    public function hasilSkripsiPenguji()
    {
        return $this->hasMany(HasilSkripsiPenguji::class, 'id_dosen');
    }
    public function hasilSkripsiPembimbing()
    {
        return $this->hasMany(HasilSkripsiPembimbing::class, 'id_dosen');
    }
}
