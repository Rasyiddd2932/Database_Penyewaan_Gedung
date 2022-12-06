<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $datas = DB::table('pesanan')
                ->join('penyewa', 'penyewa.id_penyewa', '=', 'pesanan.id_penyewa')
                ->join('gedung', 'gedung.id_gedung', '=', 'pesanan.id_gedung')
                ->get();

        return view('home.index')
            ->with('datas', $datas);
    }
}