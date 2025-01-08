<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'id_penguji_1',
        'id_penguji_2',
        'id_pembimbing',
        'id_plot_jadwal',
        'status',
        'keterangan',
        'done'
    ];

    public function penguji1()
    {
        return $this->belongsTo(Dosen::class, 'id_penguji_1');
    }

    public function penguji2()
    {
        return $this->belongsTo(Dosen::class, 'id_penguji_2');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing');
    }

    public function plotJadwal()
    {
        return $this->belongsTo(PlotJadwal::class, 'id_plot_jadwal');
    }

    public function jadwalProposals()
    {
        return $this->hasOne(JadwalProposal::class, 'id_jadwal');
    }

    public function jadwalSkripsi()
    {
        return $this->hasMany(JadwalSkripsi::class, 'id_jadwal');
    }
}
