<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_berkas_proposal',
        'id_jadwal',
    ];

    public function berkasProposal()
    {
        return $this->belongsTo(BerkasSidangProposal::class, 'id_berkas_proposal');
    }

    public function jadwalSidang()
    {
        return $this->belongsTo(JadwalSidang::class, 'id_jadwal');
    }

    public function hasilProposal()
    {
        return $this->hasMany(HasilProposal::class, 'id_jadwal_proposal');
    }
}
