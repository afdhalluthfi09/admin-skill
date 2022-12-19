<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KurikulumModel extends Model
{
    use HasFactory;

    protected $table='kurikulum_models';
    protected $fillable=['kelas_id','kurikulum'];
}
