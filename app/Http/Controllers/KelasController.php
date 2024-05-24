<?php

namespace App\Http\Controllers;

use App\Http\Requests\kelas\{KategoriRequest};
use App\Models\Kelas as ModelsKelas;
use App\Models\KurikulumModel;
use Carbon\Carbon;
// use App\Repositories\Category;
use Repositories\Category;
use Repositories\Kelas;
use Repositories\Youtube;
use Repositories\TeacherRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

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
        $kategori=Http::acceptJson()->get(config('services.api.local').'/categories');

        // dd(collect($kategori->collect()));
        return view('pages.kelas.index',with([
            'kategori' =>collect($kategori->collect())
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
    public function show ($slug) {
        // dd($slug);
        $data =Http::acceptJson()->get(config('services.api.local').'/kelas/by-category',[
            "kategory"=>$slug
        ]);
        $dataKategori =Http::acceptJson()->get(config('services.api.local').'/categories/detail/'.$slug);

        // dd($dataKategori->json());

        if($data->status() == 202){
            return view('pages.kelas.kelas',["kelas"=>$data->json(),'slug'=>$slug,'kategori'=>$dataKategori->json()]);
        }elseif($data->status() == 404){
            return view('pages.kelas.kelas',["kelas"=>[],'slug'=>$slug,'kategori'=>$dataKategori->json()]);
        }else{
            dd($data);
        }
    }

    public function addKelas (Request $request) {
        DB::beginTransaction();
        try {
            //code...
            $kelas_id = $this->kelas->addKelas($request);
            $this->profile->add($kelas_id,$request);
            $this->kelas->addKurikulum($kelas_id,$request);
            DB::commit();
            return redirect()
                    ->back()
                    ->with('Berhasil Di Tambahkan');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }



    }
    public function showListKelas($slug) {
        // dd($this->youtube->getListYoutube($slug));
        return view('pages.kelas.listkelas',with([
            'listItem' =>$this->youtube->getListItemsYoutube(),
        ]));
    }
    public function detailEvent()
    {
        return view('pages.kelas.detail',with([
            'youtube'=>collect($this->youtube->getDetailEvent())
        ]));
    }

    public function editKelas (Request $request)
    {
        $html='';
        $data =$this->kelas->apiKelasDetails($request->slug);

        // echo $html;
        if(isset($request)){
            $datas=Carbon::createFromFormat('d-m-Y',$data['jadwal'],'Asia/Jakarta')->format('Y-m-d');
            $url =config('services.api.image');
            $html .= '
            <div id="modalBody" class="modal-body">
                <input type="hidden" name="kelas_id" value='.$request->id.' />
                <!-- kelas -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <div class="card-header">
                                <h5>Kelas</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" value="'.$data["name"].'"  class="form-control" id="editName" name="name" placeholder="ex: kelas" required>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Event</label>
                                    <select id="editStatus" class="form-control select2" name="status" style="width: 100%;" required>
                                        <option value='.$data["status"].'>'.$data["status"].'</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pengisi Kelas</label>
                                    <input type="text" value="'.$data["guru"].'" class="form-control"  id="editGuru" name="guru" placeholder="ex: nama pengisi kelas" required>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Kelas</label>
                                    <input type="date" class="form-control" value='.$datas.' autocomplete="off" id="editJadwal" name="jadwal" placeholder="ex: tanggal" required>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" value='.$data["harga"].' class="form-control"  id="editHarga" name="harga" placeholder="ex: harga" required>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div id="formImagesEdit" class="form-group">
                                    <label>Poster</label>
                                    <button type="button" class="btn btn-success btn-upload-image">Upload ?</button>
                                    <input type="file" class="form-control d-none" id="editGambar" name="editGambar" placeholder="ex: gambar">
                                    <input type="hidden" class="form-control" value="'.$data['gambar'].'" id="inputGambar" name="gambar" placeholder="ex: gambar" required>
                                    <img src="'.$url.$data['gambar'].'" width=256 height=300 />
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>IDHASH</label>
                                    <input type="text" value='.$data["idhash"].' class="form-control" id="editIdhash" name="idhash" placeholder="ex: id list youtube" required>
                                </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                <label class="form-group">Deskirpsi</label>
                                <textarea name="description" id="summernoteEdit" cols="55" rows="10">'.$data["description"].'</textarea>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- profile Pemateri -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <div class="card-header">
                                <h5>Profile Pemateri</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaPemateri" class="form-label">Nama Pemateri</label>
                                            <input type="text" value="'.$data["profil"]["name"].'" id="namaPemateri" name="nameprofil" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailPemateri" class="form-label">email</label>
                                            <input type="email" value="'.$data["profil"]["email"].'" id="emailPemateri" name="email" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="agePemateri" class="form-label">umur</label>
                                            <input type="text" value="'.$data["profil"]["age"].'" id="agePemateri" name="age" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailPemateri" class="form-label">Profesi</label>
                                            <input type="text" id="emailProfesi" value="'.$data["profil"]["profesi"].'" name="profesi" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Photo</label>
                                        <button type="button" class="btn btn-success btn-upload-profil">Upload ?</button>
                                        <input type="file" class="form-control d-none" id="editPhoto" name="editPhoto">
                                        <input type="hidden" class="form-control" value="'.$data["profil"]['photo'].'" id="inputPhoto" name="photo" placeholder="ex: gambar" required>
                                        <img src="'.$url.$data["profil"]['photo'].'" width=256 height=300 />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Deskirpsi</label>
                                        <textarea id="summernoteProfileEdit" name="deskripsi">"'.$data["profil"]["deskripsi"].'"</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- module -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <div class="card-header">
                                <h5>Kurikulum</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <label>
                                    <select id="participants" class="input-mini required-entry">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                    </select></label>

                                <div class="wrapper" id="participantTable">';
                                foreach ($data["kurikulum"] as $key => $value) {
                                    # code...
                                    $html .='<div class="d-flex justify-content-between gap-1 mt-2">
                                        <input name="kurikulum[]" id="" value="'.$value["kurikulum"].'" type="text" placeholder="Name" class="required-entry form-control">
                                        <input type="hidden" name="idkurikulum[]" value="'.$value["id"].'"/>
                                        <a class="btn btn-danger remove" href="javascript:void(0)" >Remove</a>
                                    </div>';
                                }
                                $html .='</div>
                                <div class="d-flex justify-content-center mt-2">
                                    <a href="javascript:void(0)"  class="btn btn-large btn-success add" type="button">Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="modalFooter" class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>';
            // echo $url;
            echo $html;
        }else{
            $html = '<option selected value="">Choose...</option>';
            echo $html;
        }
    }

    public function updateKelas (Request $request) {
        // dd($request->nameprofil);

        DB::beginTransaction();
        try {
            //code...
            $this->kelas->editKelas($request);
            $this->profile->updateProfile($request);
            $this->kelas->updateKurikulum($request);
            DB::commit();
            return redirect()
                    ->back()
                    ->with('Berhasil Di Ubah');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

    }

    public function deletKelas (Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            //code...
            $this->kelas->deleteKelas($request);
            $this->profile->deleteProfile($request);
            $this->kelas->deleteKurikulum($request);
            DB::commit();
            return redirect()
                    ->back()
                    ->with('Berhasil Di Hapus');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function ajaxVidoe ($idplaylist) {
        echo json_encode(["succsess"=>true,"data"=>$this->youtube->playVideo($idplaylist)]);
    }
}
