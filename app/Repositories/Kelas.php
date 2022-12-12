<?php  

namespace Repositories;

use App\Models\Kelas as ModelsKelas;
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
        return ModelsKelas::create([
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
    }
}