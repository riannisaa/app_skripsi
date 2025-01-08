<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TopikModel extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_topik';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'mahasiswa_id', 'topik_id', 'judul', 'desc_judul', 'status', 'desc_status'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function dataTopik()
    {
        return $this->belongsTo(DataTopik::class, 'topik_id', 'id');
    }
}
