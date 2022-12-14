<?php  
namespace App\Repositories;

use App\Models\SopModel;

use function PHPUnit\Framework\isEmpty;

class Sop
{
    public function get()
    {
       $data = SopModel::all();
    //    isEmpty($data) ? $data = 'Maaf Data Belum ada' :  $data;
       
       return $data;
    }

    public function addSop ($request) {
        $data = new SopModel;
        $data->type = $request->type;
        $data->description = $request->description;
        $data->save();
    }

    public function updateSop ($request) 
    {
        $data = SopModel::find($request->id);
        $data->type = $request->type;
        $data->description = $request->description;
        $data->save();
    }

    public function deleteSop ($request) 
    {
        $data = SopModel::find($request->id);
        $data->delete();
    }
}