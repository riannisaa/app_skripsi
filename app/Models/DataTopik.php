<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class DataTopik extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'data_topik';
    protected $primaryKey = 'id';
    protected $fillable = ['jurusan', 'peminatan', 'topik', 'ket', 'kapasitas', 'peserta'];

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'topik_dosen', 'topik_id', 'dosen_id');
    }

    public function topik()
    {
        return $this->belongsToMany(TopikModel::class, 'id', 'topik_id');
    }
}
