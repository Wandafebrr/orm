<?php

namespace App\Models;

use App\Models\mahasiswaMatakuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah';

    public function mahasiswaMatakuliah()
    {
        return $this->hasMany(mahasiswaMatakuliah::class);
    }
}
