<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan_Penilaian extends Model
{
    use HasFactory;
    protected $table = "bahan_penilaian";
    protected $primaryKey = 'id';
    protected $fillable = [
        'link',
    ];
}
