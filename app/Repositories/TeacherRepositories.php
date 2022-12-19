<?php

namespace Repositories;

use App\Models\Teacher;

class TeacherRepositories{

    public function add ($kelas_id,$request)
    {
        // kelas_id,name,email,age,photo,address,deskripsi,profesi
        $fileName =str_replace(" ","_",$request->photo->getClientOriginalName());
        $path = $request->photo->storeAs('profil_pemateri',$fileName,'parent_disk');
        $db =Teacher::create([
            'kelas_id' =>$kelas_id,
            'name'=>$request->nama_profile,
            'email'=>$request->email,
            'age' =>$request->age,
            'photo'=>$path,
            'profesi'=>$request->profesi,
            'deskripsi'=>$request->deskripsi
        ]);
        return $db;
    }
}
