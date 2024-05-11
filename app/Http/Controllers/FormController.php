<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;


use function Termwind\render;

class FormController extends Controller
{
    //
    public function formEditKelas ($slug)
    {
        $kategori=Http::acceptJson()->get(config('services.api.local').'/categories');
        $detailKelas=Http::acceptJson()->get(config('services.api.local').'/kelas'.'/'.$slug);
        $dataKategori=$kategori->json()['data'];
        // dd($detailKelas->json());
        $dataDeatilKelas =$detailKelas->json()['data']['data'];
        $data=null;
        View::composer('pages.kelas.part.editKelas',function($view)use($dataDeatilKelas,$dataKategori){
            // dd($dataDeatilKelas);
            $view->with(['kelas'=>$dataDeatilKelas,'status'=>$dataKategori]);
        });

        $render =view('pages.kelas.part.editKelas')->render();

        return response()->json(["html"=>$render],Response::HTTP_ACCEPTED);
    }

    public function formAddKelas ()
    {
        $kategori=Http::acceptJson()->get(config('services.api.local').'/categories');
        $dataKategori=$kategori->json()['data'];
        View::composer('pages.kelas.part.addKelas',function($view)use($dataKategori){
            // dd($dataDeatilKelas);
            $view->with(['status'=>$dataKategori]);
        });
        $render = view('pages.kelas.part.addKelas')->render();
        return response()->json(['html'=>$render],Response::HTTP_ACCEPTED);
    }

    public function formAddUser ()
    {
        $render =view('pages.user.part.add')->render();
        return response()->json(["html"=>$render],Response::HTTP_ACCEPTED);
    }

    public function formAddArtikel () {
        $render = view('pages.artikel.addartikel')->render();
        return response()->json(["html"=>$render],Response::HTTP_ACCEPTED);
    }
}
