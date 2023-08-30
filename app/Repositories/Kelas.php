<?php

namespace Repositories;

use App\Models\Kelas as ModelsKelas;
use App\Models\KurikulumModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class Kelas{

    public function getKelas ()
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->get('sekolahskillapi.test/api/kelas');

            if ($response->successful()) {
                $data = $response->json()['data'];
                // Lakukan manipulasi data selanjutnya
            } else {
                // Tangani respons tidak berhasil
                $statusCode = $response->status();
                dd($statusCode);
                // Lakukan sesuatu sesuai kebutuhan, misalnya tampilkan pesan error
            }
        } catch (\Exception $e) {
            // Tangani error lainnya, seperti masalah koneksi atau exception lainnya
            // Anda dapat menampilkan pesan error atau melakukan tindakan sesuai kebutuhan
            $errorMessage = $e->getMessage();
            dd($errorMessage);
        }

        return collect($data);
    }

    public function addKelas ($request)
    {
        $fileName =str_replace(" ","_",$request->gambar->getClientOriginalName());
        $path = $request->gambar->storeAs('',$fileName,'parent_disk');
        // dd($fileName);
        $data = ModelsKelas::create([
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
        return $data->id;
    }

    public function editKelas ($request)
    {
        if($request->editGambar == null){
            $data=ModelsKelas::findOrFail($request->kelas_id);
            return (int) $data->update([
                'name'=>$request->name,
                'slug' =>Str::slug($request->name),
                'status'=>$request->status,
                'guru'=>$request->guru,
                'jadwal'=>$request->jadwal,
                'harga'=>$request->harga,
                'idhash'=>$request->idhash,
                'description'=>$request->description,
                'gambar'=>$request->gambar,
            ]);
        }else{
            $fileName =str_replace(" ","_",$request->editGambar->getClientOriginalName());
            $path = $request->editGambar->storeAs('kelas',$fileName,'parent_disk');
            $data=ModelsKelas::findOrFail($request->kelas_id);
            return (int) $data->update([
                'name'=>$request->name,
                'slug' =>Str::slug($request->name),
                'status'=>$request->status,
                'guru'=>$request->guru,
                'jadwal'=>$request->jadwal,
                'harga'=>$request->harga,
                'idhash'=>$request->idhash,
                'description'=>$request->description,
                'gambar'=>$path,
            ]);
        }
    }

    public function deleteKelas ($request)
    {
        $data =ModelsKelas::where('id',$request->kelas_id);
        return (int) $data->delete();
    }

    public function addKurikulum ($kelas_id,$request)
    {
        $data =[];
        for ($i=0; $i < count($request->kurikulum); $i++) {
            # code...
            echo $i .$request->kurikulum[$i].'<br>';
            $data [] =[
                'kelas_id'=>$kelas_id,
                'kurikulum'=>$request->kurikulum[$i]
            ];
        }
        KurikulumModel::insert($data);
    }

    public function updateKurikulum ($request)
    {
        /*
            dear develop sekolahskill after here..
            untuk kasus update multipel record yang hanya mengandalkan single column table disarankan melakukan
            rselove seperti di bawah ini,walaupun ini belum terbukti work it untuk di setiap project, tapi
            ini sudah lebih dari cukup,
            walaupun resikonya adalah bertambahnya index dari database itu sendiri tapi bisa di pastikan beberapa
            aplikasi tidak akan sering melakukan perubahan besar secara terus menerus untuk kasus multple recoerd seperti kasus
            ini..
        */

        $data=[];
        KurikulumModel::where('kelas_id',$request->kelas_id)
                    ->delete();

        for($i=0;$i <count($request->kurikulum); $i++){
            $data [] =[
                'kelas_id'=>$request->kelas_id,
                'kurikulum'=>$request->kurikulum[$i]
            ];
        }
        KurikulumModel::insert($data);
    }

    public function deleteKurikulum ($request)
    {
        $data =KurikulumModel::where('kelas_id',$request->kelas_id)
                    ->delete();
        return $data;
    }

    public function testApi ()
    {
        $client = new Client([
            'base_uri' => config('services.base_url_server.local').'api/kelas/pemograman-dasar',
            'timeout'  => 2.0,
        ]);
        $response = Http::accept('application/json')
                        ->get(config('services.base_url_server.local').'api/kelas/pemograman-dasar');

        if($response->successful()){
            return $response->collect();
        }else{
            return $response->failed();
        }
        // $response =$client->request('get');
        // $data = json_decode($response->getBody()->getContents(), true);

        // $data = ModelsKelas::all();
        // return collect($data['data']);
    }

    public function apiKelasDetails ($request)
    {
        $client = new Client([
            'base_uri' => config('services.base_url_server.local').'api/kelas/'.$request,
            'timeout'  => 2.0,
        ]);

        $response =$client->request('get');
        $data = json_decode($response->getBody()->getContents(), true);

        // $data = ModelsKelas::all();
        return collect($data['data']);
    }
}
