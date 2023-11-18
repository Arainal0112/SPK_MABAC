<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table="alternatif"; 
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'nama_alternatif',
    ];

    public function kriteria(){
        return $this->belongsToMany(Kriteria::class, 'matriks', 'kriteria_id', 'alternatif_id')->withPivot('nilai');
    }
}
