<?php

namespace App\Http\Controllers;

use App\Http\Requests\kelas\{KategoriRequest};
use App\Repositories\Kategori;
use App\Repositories\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    //
    private $kategori;
    private $kelas;

    public function __construct(Kategori $kt,Kelas $kl){
        $this->kategori = $kt;
        $this->kelas = $kl;
    }

    // proses category kelas
    public function index(){
        return view('pages.kelas.index',with([
            'kategori' =>$this->kategori->getKategori()
        ]));
    }

    public function addKategori (KategoriRequest $request) {
        $this->kategori->addKategori($request);
        return redirect()->back();
    }

    public function updateKategori (KategoriRequest $request) {
        // dd($request->all());
        $this->kategori->updateKategori($request);
        return redirect()->back();
    }

    public function deleteKategori (Request $request) {
        // dd($request->all());
        $this->kategori->deleteKategori($request);
        return redirect()->back();
    }
    // prosess kelas
    public function show ($id,$slug) {
        return view('pages.kelas.kelas',with([
            'kategori_id' => $id,
            'slug'=>$slug,
            'kelas' => $this->kelas->getKelas()
        ]));
    }

    public function addKelas (Request $request) {
        // dd($request->all());
        $this->kelas->addKelas($request);
        return redirect()->back();
        
    }
}
