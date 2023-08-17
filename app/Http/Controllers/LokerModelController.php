<?php

namespace App\Http\Controllers;

use App\Models\KategoriKerjaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Repositories\Loker;

class LokerModelController extends Controller
{
    //

    private $loker;
    public function __construct( Loker $lk)
    {
        $this->loker=$lk;
    }

    public function index ()
    {
        return view('pages.loker.index',with([
            'kerjaan'=>$this->loker->getKategoriKerjaan(),
            'perusahaan'=>$this->loker->getKategoriPerushaan()
        ]));
    }

    public function settingan () {
        return view('pages.loker.setting',with([
            'kerjaan'=>$this->loker->getKategoriKerjaan(),
            'perusahaan'=>$this->loker->getKategoriPerushaan()
        ]));
    }


    // ajax
    public function addkerjaan (Request $request) {


        DB::beginTransaction();
        try {
            //code...
            $datas=$this->loker->addKategoriKerjaan($request);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }

        $data = $this->loker->getKategoriKerjaan();
        if($data->isNotEmpty()){
            echo '<tr>
                    <td>
                    <button data-toggle="modal" data-id="'.$datas->id.'" data-kerjaan="'.$datas->name.'" data-target="#modal-edit-kerjaan" class="btn btn-primary btn-edit">Edit</button>
                    <button data-toggle="modal" data-id="'.$datas->id.'" data-target="#modal-hapus-kerjaan" class="btn btn-danger btn-hapus">Hapus</button>
                    </td>
                    <td>'.$datas->name.'</td>
                </tr>';
        }else{
            echo '<tr><td>Belum Ada</td></tr>';
        }
    }
    public function udpatekerjaan (Request $request) {

        // dd($request->nameEditKerjaan);
        KategoriKerjaModel::where('id',$request->ideditkerjaan)
                ->update(['name'=>$request->nameEditKerjaan]);
        return redirect()->route('loker.setting');

    }
    public function hapuskerjaan (Request $request) {

        $this->loker->deleteKategoriKerjaan($request);
        return redirect()->route('loker.setting');

        // $data = $this->loker->getKategoriKerjaan();
        // if($data->isNotEmpty()){
        //     foreach ($data as $item){
        //         echo '<tr>
        //                 <td>
        //                     <button data-toggle="modal" data-id="'.$item->id.'" data-kerjaan="'.$item->name.'" data-target="#modal-edit-kerjaan" class="btn btn-primary btn-edit">Edit</button>
        //                     <button data-toggle="modal" data-id="'.$item->id.'" data-target="#modal-hapus-kerjaan" class="btn btn-danger btn-hapus">Hapus</button>
        //                 </td>
        //                 <td>'.$item->name.'</td>
        //             </tr>';
        //     }
        // }else{
        //     echo '<tr><td>Belum Ada</td></tr>';
        // }
    }
}
