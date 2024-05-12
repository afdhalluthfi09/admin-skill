
<?php

use App\Http\Controllers\{ArtikelController, EmailController, EventController, FormController, KelasController, LokerModelController, PembelianController, SopModelController, UsersController};
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthChek;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome',with(['pages'=>'Home']));
});

Route::middleware([AuthChek::class])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix'=>'kelas',"middleware"=>[AuthChek::class]],function() {
    Route::get('/', [KelasController::class,'index'])->name('kelas');
    Route::post('/addKategori', [KelasController::class, 'addKategori'])->name('kelas.addKategori');
    Route::post('/updateKategori', [KelasController::class, 'updateKategori'])->name('kelas.updateKategori');
    Route::get('/deleteKategori', [KelasController::class, 'deleteKategori'])->name('kelas.deleteKategori');
    //prosess kelas
    Route::get('/list/{slug}', [KelasController::class, 'show'])->name('kelas.show');
    Route::post('/addKelas', [KelasController::class, 'addKelas'])->name('kelas.addKelas');
    Route::post('/editKelas',[KelasController::class,'editKelas'])->name('kelas.edit');
    Route::post('/updateKelas', [KelasController::class, 'updateKelas'])->name('kelas.updateKelas');
    Route::post('/deletKelas', [KelasController::class, 'deletKelas'])->name('kelas.deletKelas');
    Route::get('/listkelas/{idhash}',[KelasController::class,'showListKelas'])->name('kelas.listkelas');
    Route::get('/datail',[KelasController::class,'detailEvent'])->name('kelas.detail');

    route::post('ajax-video-player/{idplaylist}',[KelasController::class,'ajaxVidoe'])->name('kelas.video.player');
});

Route::group(["prefix"=>'artikel',"middleware"=>[AuthChek::class]],function(){
    Route::get('/',[ArtikelController::class,'index'])->name('artikel');
    Route::get('add',[ArtikelController::class,'addArtikel'])->name('artikel.add');
    Route::get('edit/{slug}',[ArtikelController::class,'editArtikel'])->name('artikel.edit');

    //prosess artikel
    Route::post('addArtikel',[ArtikelController::class,'add'])->name('artikel.addArtikel');
    Route::post('editArtikel/{id}',[ArtikelController::class,'edit'])->name('artikel.editArtikel');
    Route::get('deleteArtikel',[ArtikelController::class,'delete'])->name('artikel.deleteArtikel');
});
Route::group(["prefix"=>'users',"middleware"=>[AuthChek::class]],function(){
    Route::get('', [UsersController::class, 'index'])->name('users.index');
});

Route::group(["prefix"=>'sop',"middleware"=>[AuthChek::class]],function(){
    Route::get('', [SopModelController::class, 'index'])->name('sop.index');
    Route::post('store', [SopModelController::class, 'store'])->name('sop.store');
    Route::post('update', [SopModelController::class, 'update'])->name('sop.update');
    Route::post('delete', [SopModelController::class, 'delete'])->name('sop.delete');
});

Route::group(["prefix"=>'email',"middleware"=>[AuthChek::class]],function(){
    Route::get('', [EmailController::class, 'index'])->name('email.index');
});

Route::group(["prefix"=>'trasaction',"middleware"=>[AuthChek::class]],function(){
    Route::get('',[PembelianController::class,'index'])->name('trasaction.index');
    Route::post('',[PembelianController::class,'edit'])->name('trasaction.edit');
});

Route::group(["prefix"=>'loker',"middleware"=>[AuthChek::class]],function(){
    Route::get('',[LokerModelController::class,'index'])->name('loker.index');
    Route::get('settingan',[LokerModelController::class,'settingan'])->name('loker.setting');

    // ajax
    Route::post('addkejraan',[LokerModelController::class,'addkerjaan'])->name('loker.addkerjaan');
    Route::post('updatekejraan',[LokerModelController::class,'udpatekerjaan'])->name('loker.updatekerjaan');
    Route::post('hapuskerjaan',[LokerModelController::class,'hapuskerjaan'])->name('loker.hapuskerjaan');

});

Route::group(["prefix"=>'form',"middleware"=>[AuthChek::class]],function(){
    Route::get('edit-kelas/{slug}',[FormController::class,'formEditKelas']);
    Route::get('add-kelas',[FormController::class,'formAddKelas']);
    Route::get('add-user',[FormController::class,'formAddUser']);
    Route::get('add-artikel',[FormController::class,'formAddArtikel']);
});

Route::group(["prefix"=>'event',"middleware"=>[AuthChek::class]],function(){
    Route::get('/',[EventController::class,'listEvent'])->name('event.list');
    Route::get('add',[EventController::class,'addEvent'])->name('event.add');
    Route::post('addEvent',[EventController::class,'addEvent'])->name('event.addEvent');
    Route::get('edit/{slug}',[EventController::class,'editEvent'])->name('event.edit');
    Route::post('editEvent/{id}',[EventController::class,'editEvent'])->name('event.editEvent');
    Route::get('deleteEvent',[EventController::class,'deleteEvent'])->name('event.deleteEvent');
    Route::get('setting',[EventController::class,'setting'])->name('event.setting');
});

Route::get('keluar',function(){
    Session::flush();
    return redirect()->route('login');
})->name('keluar');

require __DIR__.'/auth.php';
