<?php

namespace App\Http\Controllers;

use App\DataTables\PembelianDatableDataTable;
use App\Models\PembelianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Repositories\Pembelian;
use App\Mail\NotifProduct;
use Illuminate\Support\Facades\Mail;

class PembelianController extends Controller
{
    //
    private $pembelian;
    public function __construct(Pembelian $pb)
    {
            $this->pembelian= $pb;
    }

    public function index (PembelianDatableDataTable $dataTable)
    {
        return $dataTable->render('pages.pembelian.index');
    }

    public function edit (Request $request)
    {
       DB::beginTransaction();
       try {
        //code...
        $this->pembelian->update($request);
        Mail::to($request->email)->send(new NotifProduct());
        DB::commit();
        return redirect()
                    ->route('trasaction.index')
                    ->with('Berhasil Di Ubah');
       } catch (\Throwable $th) {
        //throw $th;
        dd($th);
        return redirect()
                    ->route('trasaction.index')
                    ->with('Terjadih Keselahan');
       }


    }
}
