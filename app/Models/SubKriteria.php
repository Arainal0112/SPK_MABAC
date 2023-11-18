<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $table="sub_kriteria"; 
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'kriteria_id',
        'nama_sub',
        'nilai_sub',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
