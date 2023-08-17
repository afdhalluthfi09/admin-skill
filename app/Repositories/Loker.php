<?php

namespace Repositories;

use App\Models\KategoriKerjaModel;
use App\Models\KategoriPerushaanModel;

class Loker{

    //submit kategori kerjaan
    public function addKategoriKerjaan ($request) {
        $db=KategoriKerjaModel::create(['name'=>$request->name]);
        return $db;
    }
    public function updateKategoriKerjaan ($request) {
        $db=KategoriKerjaModel::findOrFail($request->idekerjaan);
        return $db;
    }
    public function deleteKategoriKerjaan ($request) {
        $db = KategoriKerjaModel::where('id',$request->idehapuskerjaan)
                ->delete();
        return $db;
    }

    //submit kategor perusahaan
    public function addKategoriPerusahaan () {}

    //get
    public function getKategoriKerjaan ()
    {
        $db =KategoriKerjaModel::all();

        return $db;
    }
    public function getKategoriPerushaan () {
        $db =KategoriPerushaanModel::all();
        return $db;
    }

}
