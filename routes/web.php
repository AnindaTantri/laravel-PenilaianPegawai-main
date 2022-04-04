<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenugasanController;
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

Route::get('/', [PenilaianController::class, 'home'])->name('homepage');
Route::get('penilaian/{id}', [PenilaianController::class, 'create'])->name('penilaian.create');
Route::post('penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
Route::get('penilaian-success', function() {
    return view('penilaian.success');
});
Route::get('jabatanPegawai/{id}', [PegawaiController::class, 'getJabatanById'])->name('jabatanById');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('employees', PegawaiController::class);
    Route::resource('penugasan', PenugasanController::class);
    Route::get('pegawai/{kesulitan}', [PegawaiController::class, 'getPegawaiByKekuatan'])->name('pegawaiByKekuatan');
    Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('penilaian/detail/{id}', [PenilaianController::class, 'show'])->name('penilaian.show');
});
