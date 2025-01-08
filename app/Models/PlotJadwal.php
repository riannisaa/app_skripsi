<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ruangan',
        'waktu',
        'tanggal',
        'prodi',
        'jenis_sidang',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function ketersediaanDosens()
    {
        return $this->hasMany(KetersediaanDosen::class, 'id_plot_jadwal');
    }

    public function jadwalSidangs()
    {
        return $this->hasMany(JadwalSidang::class, 'id_plot_jadwal');
    }
}
