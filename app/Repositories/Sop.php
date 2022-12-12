<?php  
namespace App\Repositories;

use App\Models\SopModel;

use function PHPUnit\Framework\isEmpty;

class Sop
{
    public function get()
    {
       $data = SopModel::all();
       isEmpty($data) ? $data = 'Maaf Data Belum ada' :  $data;
       
       return $data;
    }
}