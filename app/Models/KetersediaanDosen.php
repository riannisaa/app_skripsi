<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetersediaanDosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_plot_jadwal',
        'id_dosen',
        'used',
    ];

    public function plotJadwal()
    {
        return $this->belongsTo(PlotJadwal::class, 'id_plot_jadwal');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
