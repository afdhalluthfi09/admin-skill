<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokerModel extends Model
{
    use HasFactory;

    /*
        kerjaan
        perusahaan
        spesifikasi
        lokasi
        gaji_min
        gaji_max
        img_hero
        img_thumb
        create_at
        deadline_regis
        dilihat
        kategori_kerja_id
        kategori_perusahaan_id
        persyaratan
        profil_perushaan
        deskripsi_kerja
        keretria_pekerja
        keahlihan
    */

    protected $table ='loker_models';
    protected $fillable=[
        'kerjaan',
        'perusahaan',
        'spesifikasi',
        'lokasi',
        'gaji_min',
        'gaji_max',
        'img_hero',
        'img_thumb',
        'create_at',
        'deadline_regis',
        'dilihat',
        'kategori_kerja_id',
        'kategori_perusahaan_id',
        'persyaratan',
        'profil_perushaan',
        'deskripsi_kerja',
        'keretria_pekerja',
        'keahlihan',
    ];

}
