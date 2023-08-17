<?php

namespace App\Http\Controllers;

use App\DataTables\SopDataTable;
use App\Repositories\Sop;
use Illuminate\Http\Request;

class SopModelController extends Controller
{
    //
    private $sop;
    public function __construct(Sop $sop)
    {
        $this->sop = $sop;
    } 
    public function index(SopDataTable $dataTable)
    {
        // return $dataTable->render('pages.sop.index');
        return view('pages.sop.index', [
            'sop' => $this->sop->get()
        ]);
    }

    public function store (Request $request) {
        // dd($request->all());
        $this->sop->addSop($request);
        return redirect()
                ->route('sop.index')
                ->with('success','Data Berhasil Ditambahkan');
    }

    public function update (Request $request) 
    {
        $this->sop->updateSop($request);
        return redirect()
                ->route('sop.index')
                ->with('success','Data Berhasil Diubah');
    }

    public function delete (Request $request) 
    {
        $this->sop->deleteSop($request);
        return redirect()
                ->route('sop.index')
                ->with('success','Data Berhasil Dihapus');
    }
}
