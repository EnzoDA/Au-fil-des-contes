<?php

use App\Http\Controllers\CaverneController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Caverne;
use App\Models\Histoire;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HistoireController;
use App\Http\Controllers\CommentaireController;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect()->route('caverne.index');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('tags', TagController::class);

Route::resources([
    'user' => UserController::class,
    'caverne' => CaverneController::class,
    'histoire' => HistoireController::class,
    'commentaire' => CommentaireController::class,

]);

Route::post('store_histoire/{id}', [HistoireController::class, 'store_hist'])->name('store_histoire');
Route::get('histoirecaverne/{id}', [HistoireController::class, 'hist_cav'])->name('histoirecaverne');
Route::get('livre_d_or', [CommentaireController::class, 'livredor'])->name('livre_d_or');
Route::get('createhistoire/{id}', [HistoireController::class, 'create_histoire'])->name('createhistoire');
