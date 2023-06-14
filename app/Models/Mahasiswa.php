<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\mahasiswaMatakuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswas";
    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }


    public function mahasiswaMatakuliah()
    {
        return $this->hasMany(mahasiswaMatakuliah::class);
    }
};
