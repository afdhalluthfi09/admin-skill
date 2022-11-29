<?php

namespace App\Http\Controllers;

use App\Repositories\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    //
    private $artikel;

    public function __construct(Artikel $artikel)
    {
        $this->artikel = $artikel;
    }

    public function index () 
    {

        return view('pages.artikel.index',with([
            'artikel' => $this->artikel->getArtikel()
        ]));
    }

    public function addArtikel () {
        return view('pages.artikel.addartikel');
    }
    public function editArtikel ($slug) {
        return view('pages.artikel.editartikel',with([
            'artikel' => $this->artikel->show($slug)
        ]));
    }

    public function add (Request $request) {
        // dd($request->all());
        
        $this->artikel->add($request);

        return redirect()->route('artikel')->with('success', 'Artikel berhasil ditambahkan');
    }
    public function edit (Request $request,$id) {
        // dd($request->all());
        
        $this->artikel->edit($request,$id);

        return redirect()->route('artikel')->with('success', 'Artikel berhasil diubah');
    }

    public function delete (Request $request) {
        // dd($request->all());
        $this->artikel->delete($request);
        return redirect()->back();
    }




}
