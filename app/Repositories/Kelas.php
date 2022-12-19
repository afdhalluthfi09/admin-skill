<?php

namespace Repositories;

use App\Models\Kelas as ModelsKelas;
use App\Models\KurikulumModel;
use Illuminate\Support\Str;
class Kelas{

    public function getKelas () {
        $collection = ModelsKelas::all();
        return $collection;
    }

    public function addKelas ($request) {
        $fileName =str_replace(" ","_",$request->gambar->getClientOriginalName());
        $path = $request->gambar->storeAs('kelas',$fileName,'parent_disk');
        // dd($fileName);
        $data = ModelsKelas::create([
            'name' => $request->name,
            'slug'=> Str::slug($request->name),
            'gambar' => $path,
            'idhash' => $request->idhash,
            'guru' => $request->guru,
            'description' => $request->description,
            'harga' => $request->harga,
            'status' => $request->status,
            'jadwal' => $request->jadwal,
            'categorise_id' => $request->categorise_id,
        ]);
        return $data->id;
    }

    public function editKelas ($request)
    {
        $data =ModelsKelas::where('id',$request->id)
                            ->first();
        return $data;
    }

    public function addKurikulum ($kelas_id,$request)
    {
        $data =[];
        for ($i=0; $i < count($request->kurikulum); $i++) {
            # code...
            echo $i .$request->kurikulum[$i].'<br>';
            $data [] =[
                'kelas_id'=>$kelas_id,
                'kurikulum'=>$request->kurikulum[$i]
            ];
        }
        KurikulumModel::insert($data);
    }
}
