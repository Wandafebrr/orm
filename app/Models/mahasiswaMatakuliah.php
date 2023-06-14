<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mahasiswaMatakuliah extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'mahasiswa_matakuliah';

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class);
    }

    public function matakuliah(){
        return $this->belongsTo(MataKuliah::class);
    }
}
