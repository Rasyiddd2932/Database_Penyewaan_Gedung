<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;


class PenyewaController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('penyewa')->where('deleted_at', '<>', '' )->where('nama', 'LIKE', '%'.$get_nama.'%')->get();
        return view('penyewa.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE penyewa SET deleted_at = NULL WHERE id_penyewa = :id_penyewa', ['id_penyewa' => $id]);
        return redirect()->route('penyewa.trash')->with('success', 'Data penyewa berhasil restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from penyewa where deleted_at is not null');
        return view('penyewa.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE penyewa SET deleted_at=current_timestamp() WHERE id_penyewa = :id_penyewa', ['id_penyewa' => $id]);
        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil dihapus');
    }
    public function search(Request $request)
    {

        $get_nama = $request->nama;
        $datas = DB::table('penyewa')->where('deleted_at', NULL )->where('nama', 'LIKE', '%'.$get_nama.'%')->get();
        return view('penyewa.index')->with('datas', $datas);
    } 
    public function index() {
        $datas = DB::select('select * from penyewa  where deleted_at is null');

        return view('penyewa.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('penyewa.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_penyewa' => 'required',
            'nama' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO penyewa(id_penyewa, nama, no_telpon, email) VALUES (:id_penyewa, :nama, :no_telpon, :email)',
        [
            'id_penyewa' => $request->id_penyewa,
            'nama' => $request->nama,
            'no_telpon' => $request->no_telpon,
            'email' => $request->email,
            
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('penyewa')->where('id_penyewa', $id)->first();

        return view('penyewa.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_penyewa' => 'required',
            'nama' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE penyewa SET id_penyewa = :id_penyewa, nama = :nama, no_telpon= :no_telpon, email = :email WHERE id_penyewa = :id',
        [
            'id' => $id,
            'id_penyewa' => $request->id_penyewa,
            'nama' => $request->nama,
            'no_telpon' => $request->no_telpon,
            'email' => $request->email,
        ]
        );
        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM penyewa WHERE id_penyewa = :id_penyewa', ['id_penyewa'=> $id]);
        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil dihapus');

        //$id->delete();
        //return redirect()->route('penyewa.index');
    }

    // public function search(Request $request)
    // {
    //     $get_nama = $request->nama;
    //     $datas = DB::table('penyewa')->where('nama', 'LIKE', '%'.$get_nama.'%')->get();
    //     return view('penyewa.index')->with('datas', $datas);
    // }





}
