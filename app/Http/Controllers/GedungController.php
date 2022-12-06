<?php

namespace App\Http\Controllers;

use App\Models\gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class GedungController extends Controller
{
    public function index() {
        $datas = DB::select('select * from gedung');

        return view('gedung.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('gedung.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_gedung' => 'required',
            'lokasi' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO gedung(id_gedung, lokasi, tipe, harga) VALUES (:id_gedung, :lokasi, :tipe, :harga)',
        [
            'id_gedung' => $request->id_gedung,
            'lokasi' => $request->lokasi,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'lokasi_admin' => $request->lokasi_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('gedung')->where('id_gedung', $id)->first();

        return view('gedung.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_gedung' => 'required',
            'lokasi' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE gedung SET id_gedung = :id_gedung, lokasi = :lokasi, tipe= :tipe, harga = :harga WHERE id_gedung = :id',
        [
            'id' => $id,
            'id_gedung' => $request->id_gedung,
            'lokasi' => $request->lokasi,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
        ]
        );
        return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM gedung WHERE id_gedung = :id_gedung', ['id_gedung' =>$id]);
        return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil dihapus');
        //$gedung->delete();
        //return redirect('/gedung');
        // Menggunakan laravel eloquent
         //Admin::where('id_admin', $id)->delete();

        //return redirect()->route('gedung.index')->with('success', 'Data gedung berhasil dihapus');
    } 

    public function search(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('gedung')->where('lokasi', 'LIKE', '%'.$get_nama.'%')->get();
        return view('gedung.index')->with('datas', $datas);
    }

       
}
