<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPerushaanModel extends Model
{
    use HasFactory;

    protected $table ='kategori_perushaan_models';
    protected $fillable=['name'];
}
