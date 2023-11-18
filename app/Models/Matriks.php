<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matriks extends Model
{
    use HasFactory;
    protected $table ='matriks';

    function kriteria(){
        return $this->belongsTo(Kriteria::class);
    }
    function alternatif(){
        return $this->belongsTo(Alternatif::class);
    }
}
