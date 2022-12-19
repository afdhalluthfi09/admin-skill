<?php

namespace App\Http\Controllers;

use App\Http\Requests\kelas\{KategoriRequest};
use App\Models\KurikulumModel;
// use App\Repositories\Category;
use Repositories\Category;
use Repositories\Kelas;
use Repositories\Youtube;
use Repositories\TeacherRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class KelasController extends Controller
{
    //
    private $kategori;
    private $kelas;
    private $youtube;
    private $profile;

    public function __construct(Category $kt,Kelas $kl,Youtube $yt, TeacherRepositories $pf){
        $this->kategori = $kt;
        $this->kelas = $kl;
        $this->youtube = $yt;
        $this->profile =$pf;
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
        // dd($request->all());
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
        // dd($request->kurikulum);

        // return 'berhasil';
        DB::beginTransaction();
        try {
            //code...
            $kelas_id = $this->kelas->addKelas($request);
            $this->profile->add($kelas_id,$request);
            $this->kelas->addKurikulum($kelas_id,$request);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }



    }
    public function showListKelas() {
        return view('pages.kelas.listkelas',with([
            'yt' =>$this->youtube->getListYoutube(),
        ]));
    }
    public function detailEvent()
    {
        return view('pages.kelas.detail',with([
            'youtube'=>collect($this->youtube->getDetailEvent())
        ]));
    }

    public function updateKelas (Request $request) {
        // return $this->kelas->editKelas($request);
        dd($request->all());
    }
}
