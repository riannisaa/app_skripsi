<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dosen',
        'id_jadwal_proposal',
        'kesesuaian',
        'kedalaman',
        'rumusan',
        'penguasaan',
        'metode',
        'saran',
    ];

    // Define the relationships
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function jadwalProposal()
    {
        return $this->belongsTo(JadwalProposal::class, 'id_jadwal_proposal');
    }
}
