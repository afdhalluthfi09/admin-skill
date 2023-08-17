<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopModel extends Model
{
    use HasFactory;

    protected $table = 'sop_models';
    protected $fillable = [
        'type',
        'description',
    ];
}
