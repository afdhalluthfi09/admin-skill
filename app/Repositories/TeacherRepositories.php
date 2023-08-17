<?php

namespace Repositories;

use App\Models\Teacher;

class TeacherRepositories{

    public function add ($kelas_id,$request)
    {
        // kelas_id,name,email,age,photo,address,deskripsi,profesi
        $fileName =str_replace(" ","_",$request->photo->getClientOriginalName());
        $path = $request->photo->storeAs('',$fileName,'parent_disk');
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

    public function updateProfile ($request)
    {
        // $db = new Teacher();
        if($request->editPhoto == null){
            $db =Teacher::where('kelas_id',$request->kelas_id);
            return (int) $db->update([
                'name' => $request->nameprofil,
                'email' => $request->email,
                'age' => $request->age,
                'photo' => $request->photo,
                'profesi' => $request->profesi,
                'deskripsi' => $request->deskripsi,
            ]);
        }else{
            $fileName =str_replace(" ","_",$request->editPhoto->getClientOriginalName());
            $path = $request->editPhoto->storeAs('',$fileName,'parent_disk');
            $db =Teacher::where('kelas_id',$request->kelas_id);
            return (int) $db->update([
                'name' => $request->nameprofil,
                'email' => $request->email,
                'age' => $request->age,
                'photo' => $path,
                'profesi' => $request->profesi,
                'deskripsi' => $request->deskripsi,
            ]);
        }
    }

    public function deleteProfile ($request)
    {
        $db =Teacher::where('kelas_id',$request->kelas_id);
        return (int) $db->delete();
    }
}
