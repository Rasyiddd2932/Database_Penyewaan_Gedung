<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PesananController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_kode_order = $request->nama;
        $datas = DB::table('pesanan')->where('deleted_at', '<>', '' )->where('kode_order', 'LIKE', '%'.$get_kode_order.'%')->get();
        return view('pesanan.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE pesanan SET deleted_at = NULL WHERE kode_order = :kode_order', ['kode_order' => $id]);
        return redirect()->route('pesanan.trash')->with('success', 'Data pesanan berhasil restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from pesanan where deleted_at is not null');
        return view('pesanan.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE pesanan SET deleted_at=current_timestamp() WHERE kode_order = :kode_order', ['kode_order' => $id]);
        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil dihapus');
    }
    public function search(Request $request)
    {

        $get_kode_pesanan= $request->nama;
        $datas = DB::table('pesanan')->where('deleted_at', NULL )->where('kode_order', 'LIKE', '%'.$get_kode_pesanan.'%')->get();
        return view('pesanan.index')->with('datas', $datas);
    } 
    public function index() {
        $datas = DB::select('select * from pesanan  where deleted_at is null');

        return view('pesanan.index')
            ->with('datas', $datas);
    }


    public function create() {
        $options = DB::select('select id_penyewa, nama from penyewa');
        $goptions = DB::select('select id_gedung, id_gedung from gedung');
        return view('pesanan.add')->with('options', $options)-> with('goptions', $goptions);
    }

    public function store(Request $request) {
        $request->validate([
            'id_penyewa' => 'required',
            'id_gedung' => 'required',
            'kode_order' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pesanan(id_penyewa, id_gedung, kode_order, tgl_mulai, tgl_selesai) VALUES (:id_penyewa, :id_gedung, :kode_order, :tgl_mulai, :tgl_selesai)',
        [
            'id_penyewa' => $request->id_penyewa,
            'id_gedung' => $request->id_gedung,
            'kode_order' => $request->kode_order,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            
        ]
        );
 
        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'id_gedung_admin' => $request->id_gedung_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('pesanan.index');
    }

    public function edit($id) {
        $data = DB::table('pesanan')->where('kode_order', $id)->first();

        return view('pesanan.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_penyewa' => 'required',
            'id_gedung' => 'required',
            'kode_order' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pesanan SET kode_order = :id_penyewa, id_gedung = :id_gedung, kode_order= :kode_order, tgl_mulai = :tgl_mulai, tgl_selesai = :tgl_selesai WHERE kode_order = :id',
        [
            'id' => $id,
            'id_penyewa' => $request->id_penyewa,
            'id_gedung' => $request->id_gedung,
            'kode_order' => $request->kode_order,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            
        ]
        );
        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pesanan WHERE kode_order = :kode_order', ['kode_order' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil dihapus');
    }

    // public function search(Request $request)
    // {
    //     $get_nama = $request->nama;
    //     //$datas = DB::table('pesanan')->where('pesanan', 'LIKE', '%'.$get_nama)->get();
    //     $datas = DB::select('SELECT * FROM pesanan WHERE tgl_mulai = :tanggal',
    //     [
    //         'tanggal' => $get_nama,]
    //     );
    //     return view('pesanan.index')->with('datas', $datas);
    // }
}
