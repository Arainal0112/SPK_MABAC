<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table="kriteria"; 
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
    ];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function alternatif(){
        return $this->belongsToMany(Alternatif::class, 'matriks', 'kriteria_id', 'alternatif_id')->withPivot('nilai');
    }

}
