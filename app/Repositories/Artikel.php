<?php  

// namespace App\Repositories;
namespace Repositories;


use App\Models\Artikel as ModelsArtikel;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Path\To\DOMDocument;
class Artikel{
    public function getArtikel(){

        $collection = ModelsArtikel::all();
        return $collection;
    }

    public function show ($slug) {
        $artikel = ModelsArtikel::where('slug', $slug)->first();
        return $artikel;
    }

    public function add ($request) {
        
        $storage ='storage/content';
        $dom =new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTMLFile($request->isi,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            if(preg_match('/data:image/', $data)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid();
                $fileNameContentRand=substr(md5($filename),6,6).'_'.time(); 
                $filepath = "{$storage}/{$fileNameContentRand}.{$mimetype}";
                $image =Image::make($data)
                                ->resize(300,300)
                                ->encode($mimetype,100)
                                ->save(public_path($filepath));
                if(file_put_contents($filepath, base64_decode(preg_replace('/data:image\/.*?;base64,/', '', $data)))){
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                    $img->setAttribute('class', 'img-responsive');
                }
            }
        }
        
        
        
        $fileName =str_replace(" ","_",$request->gambar->getClientOriginalName());
        $path = $request->gambar->storeAs('artikel',$fileName,'parent_disk');



        $artikel =ModelsArtikel::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori' => $request->kategori,
            'gambar' => $path,
            'isi' => $request->isi,
            // 'isi' => $dom->saveHTML(),
        ]);
        return $artikel;
    }

    public function edit ($request,$id) {
        $artikel = ModelsArtikel::where('id', $id)->first();
        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul);
        $artikel->kategori = $request->kategori;
        $artikel->gambar = $request->gambar;
        $artikel->isi = $request->isi;
        $artikel->save();
        return $artikel;
    }

    public function delete ($request) {
        $artikel = ModelsArtikel::where('id', $request->id)->first();
        $artikel->delete();
        return redirect()->route('artikel')->with('success', 'Artikel berhasil dihapus');
    }
}