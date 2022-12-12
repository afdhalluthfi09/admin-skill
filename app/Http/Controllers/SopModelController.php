<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        return view('pages.sop.index',with([
            'data' => $this->sop->get()
        ]));
    }

    public function store (Request $request) {
        dd($request->all());
    }
}
