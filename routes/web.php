
<?php

use App\Http\Controllers\{ArtikelController, KelasController, UsersController};
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::get('/{id}/{slug}', [KelasController::class, 'show'])->name('kelas.show');
    Route::post('/addKelas', [KelasController::class, 'addKelas'])->name('kelas.addKelas');
    Route::get('/listkelas',[KelasController::class,'showListKelas'])->name('kelas.listkelas');
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

require __DIR__.'/auth.php';
