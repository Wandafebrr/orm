<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa_MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah_mahasiswa';
    protected $fillable = ['mahasiswa_id'];

    public function matakuliah()
{
    return $this->belongsToMany(MataKuliah::class);
}
}

