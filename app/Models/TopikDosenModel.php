<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopikDosenModel extends Model
{
    use HasFactory;

    protected $table = 'topik_dosen';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'topik_id', 'dosen_id'];
}
