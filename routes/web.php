<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

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

//
Route::get('/', function () {
    return view('welcome'); });

Route::get('/penyewa', [PenyewaController::class, 'index'])->name('penyewa.index');
Route::get('/penyewa/add', [PenyewaController::class, 'create'])->name('penyewa.create');
Route::post('/penyewa/store', [PenyewaController::class, 'store'])->name('penyewa.store');
Route::get('/penyewa/edit/{id}', [PenyewaController::class, 'edit'])->name('penyewa.edit');
Route::post('/penyewa/update/{id}', [PenyewaController::class, 'update'])->name('penyewa.update');
Route::post('/penyewa/delete/{id}', [PenyewaController::class, 'delete'])->name('penyewa.delete');
Route::get('/penyewa/trash', [PenyewaController::class, 'trash'])->name('penyewa.trash');
Route::get('/penyewa/hide/{id}', [PenyewaController::class, 'hide'])->name('penyewa.hide');
Route::get('/penyewa/search', [PenyewaController::class, 'search'])->name('penyewa.search');
Route::get('/penyewa/restore/{id}', [PenyewaController::class, 'restore'])->name('penyewa.restore');
Route::get('/penyewa/search/trash', [PenyewaController::class, 'search_trash'])->name('penyewa.search_trash');

Route::get('/gedung', [GedungController::class, 'index'])->name('gedung.index');
Route::get('/gedung/add', [GedungController::class, 'create'])->name('gedung.create');
Route::post('/gedung/store', [GedungController::class, 'store'])->name('gedung.store');
Route::get('/gedung/edit/{id}', [GedungController::class, 'edit'])->name('gedung.edit');
Route::post('/gedung/update/{id}', [GedungController::class, 'update'])->name('gedung.update');
Route::post('/gedung/delete/{id}', [GedungController::class, 'delete'])->name('gedung.delete');
Route::get('/gedung/search', [GedungController::class, 'search'])->name('gedung.search');
//Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/add', [PesananController::class, 'create'])->name('pesanan.create');
Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
Route::get('/pesanan/edit/{id}', [PesananController::class, 'edit'])->name('pesanan.edit');
Route::post('/pesanan/update/{id}', [PesananController::class, 'update'])->name('pesanan.update');
Route::post('/pesanan/delete/{id}', [PesananController::class, 'delete'])->name('pesanan.delete');
Route::get('/pesanan/trash', [PesananController::class, 'trash'])->name('pesanan.trash');
Route::get('/pesanan/hide/{id}', [PesananController::class, 'hide'])->name('pesanan.hide');
Route::get('/pesanan/search', [PesananController::class, 'search'])->name('pesanan.search');
Route::get('/pesanan/restore/{id}', [PesananController::class, 'restore'])->name('pesanan.restore');
Route::get('/pesanan/search/trash', [PesananController::class, 'search_trash'])->name('pesanan.search_trash');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::get('/login/store', [LoginController::class, 'store'])->name('login.store');
