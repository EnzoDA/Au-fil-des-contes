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
    return redirect()->route('livre_d_or');
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

Route::middleware('auth')->group(function () {
Route::resources([
    'user' => UserController::class,
    'caverne' => CaverneController::class,
    'commentaire' => CommentaireController::class,
    'tag' => TagController::class,

]);

/*---------------------------------HISTOIRE CONTROLLER---------------------------------*/
Route::get('histoire/{histoire}', [HistoireController::class, 'index'])->name('histoire.index');

Route::get('histoire/create/{id}', [HistoireController::class, 'create'])->name('histoire.create');
Route::post('histoire/{id}', [HistoireController::class, 'store'])->name('histoire.store');

Route::get('histoire/{histoire}/edit', [HistoireController::class, 'edit'])->name('histoire.edit');
Route::put('histoire/{id}', [HistoireController::class, 'update'])->name('histoire.update');

Route::delete('histoire/{histoire}', [HistoireController::class, 'destroy'])->name('histoire.destroy');

Route::get('histoire/{histoire}/tag', [HistoireController::class, 'tag_show'])->name('histoire.tag.show');
Route::post('histoire/tag/{histoire}', [HistoireController::class, 'tag_update'])->name('histoire.tag.update');
});


Route::get('livre_d_or', [CommentaireController::class, 'livredor'])->name('livre_d_or');
