<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianModel extends Model
{
    use HasFactory;

    protected $table ='pembelian_models';
    protected $fillable =[
        'status',
        'code',
    ];


    public function kelas ()
    {
        return $this->belongsTo(Kelas::class,'kelas_id','id');
    }
}
