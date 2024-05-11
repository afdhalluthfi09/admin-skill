<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table ='teachers';
    // kelas_id,name,email,age,photo,address,deskripsiprofesi
    protected $fillable=[
        'kelas_id',
        'name',
        'email',
        'age',
        'photo',
        'address',
        'deskripsi',
        'profesi'];
}
