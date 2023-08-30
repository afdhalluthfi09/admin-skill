
<?php

use App\Http\Controllers\{ArtikelController, EmailController, KelasController, LokerModelController, PembelianController, SopModelController, UsersController};
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth.chek'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('kelas')->middleware('auth')->group(function () {
    Route::get('/', [KelasController::class,'index'])->name('kelas');
    Route::post('/addKategori', [KelasController::class, 'addKategori'])->name('kelas.addKategori');
    Route::post('/updateKategori', [KelasController::class, 'updateKategori'])->name('kelas.updateKategori');
    Route::get('/deleteKategori', [KelasController::class, 'deleteKategori'])->name('kelas.deleteKategori');
    //prosess kelas
    Route::get('/list/{id}/{slug}', [KelasController::class, 'show'])->name('kelas.show');
    Route::post('/addKelas', [KelasController::class, 'addKelas'])->name('kelas.addKelas');
    Route::post('/editKelas',[KelasController::class,'editKelas'])->name('kelas.edit');
    Route::post('/updateKelas', [KelasController::class, 'updateKelas'])->name('kelas.updateKelas');
    Route::post('/deletKelas', [KelasController::class, 'deletKelas'])->name('kelas.deletKelas');
    Route::get('/listkelas/{idhash}',[KelasController::class,'showListKelas'])->name('kelas.listkelas');
    Route::get('/datail',[KelasController::class,'detailEvent'])->name('kelas.detail');
});

Route::prefix('artikel')->middleware('auth')->group(function(){
    Route::get('/',[ArtikelController::class,'index'])->name('artikel');
    Route::get('add',[ArtikelController::class,'addArtikel'])->name('artikel.add');
    Route::get('edit/{slug}',[ArtikelController::class,'editArtikel'])->name('artikel.edit');

    //prosess artikel
    Route::post('addArtikel',[ArtikelController::class,'add'])->name('artikel.addArtikel');
    Route::post('editArtikel/{id}',[ArtikelController::class,'edit'])->name('artikel.editArtikel');
    Route::get('deleteArtikel',[ArtikelController::class,'delete'])->name('artikel.deleteArtikel');
});
Route::prefix('users')->middleware('auth')->group(function(){
    Route::get('', [UsersController::class, 'index'])->name('users.index');
});

Route::prefix('sop')->middleware('auth')->group(function(){
    Route::get('', [SopModelController::class, 'index'])->name('sop.index');
    Route::post('store', [SopModelController::class, 'store'])->name('sop.store');
    Route::post('update', [SopModelController::class, 'update'])->name('sop.update');
    Route::post('delete', [SopModelController::class, 'delete'])->name('sop.delete');
});

Route::prefix('email')->middleware('auth')->group(function(){
    Route::get('', [EmailController::class, 'index'])->name('email.index');
});

Route::prefix('transaction')->middleware('auth')->group(function(){
    Route::get('',[PembelianController::class,'index'])->name('trasaction.index');
    Route::post('',[PembelianController::class,'edit'])->name('trasaction.edit');
});

Route::prefix('loker')->middleware(['auth'])->group(function(){
    Route::get('',[LokerModelController::class,'index'])->name('loker.index');
    Route::get('settingan',[LokerModelController::class,'settingan'])->name('loker.setting');

    // ajax
    Route::post('addkejraan',[LokerModelController::class,'addkerjaan'])->name('loker.addkerjaan');
    Route::post('updatekejraan',[LokerModelController::class,'udpatekerjaan'])->name('loker.updatekerjaan');
    Route::post('hapuskerjaan',[LokerModelController::class,'hapuskerjaan'])->name('loker.hapuskerjaan');

});

require __DIR__.'/auth.php';
