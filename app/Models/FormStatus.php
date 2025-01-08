<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormStatus extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'form_id,', 'accepting_responses'];

}
