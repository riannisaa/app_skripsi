<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Mahasiswa extends Model
{
    use Sortable;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'nama_mahasiswa', 'nim', 'prodi', 'peminatan', 'dosenpa_id', 'status_mhs'];
    public $sortable = ['jurusan', 'peminatan'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'dosenpa_id', 'id');
    }

    public function topik()
    {
        return $this->hasMany(TopikModel::class, 'mahasiswa_id');
    }

    public function rekomendasi()
    {
        return $this->hasOne(RekomendasiModel::class, 'id', 'mahasiswa_id');
    }

    public function dospem()
    {
        return $this->hasOne(DospemModel::class, 'mahasiswa_id');
    }

}

