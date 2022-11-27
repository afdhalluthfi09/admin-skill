<?php
namespace App\Repositories;

use App\Models\Categoris;
use Illuminate\Support\Str;
class Category{

    public function getKategori () 
    {   
        $collection = Categoris::all();
        return $collection;
    }


    public function addKategori($request) {
        $kategori =Categoris::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>$request->status,
        ]);
        return $kategori;
    }

    public function updateKategori ($request) {
        $kategori = Categoris::find($request->id);
        $kategori->name = $request->name;
        $kategori->slug = Str::slug($request->name);
        $kategori->status = $request->status;
        $kategori->save();
        return $kategori;
    }

    public function deleteKategori ($request) {
        $kategori = Categoris::find($request->id);
        $kategori->delete();
        return $kategori;
    }
}