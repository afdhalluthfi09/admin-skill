<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKerjaModel extends Model
{
    use HasFactory;

    protected $table='kategori_kerja_models';
    protected $fillable=['name'];
}
