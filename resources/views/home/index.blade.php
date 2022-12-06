@extends('home.layout')
@section('content')

<a href="{{ route('home.index') }}" type="button" class="btn btn rounded-3">Home</a>
<a href="{{ route('penyewa.index') }}" type="button" class="btn btn rounded-3">Data Penyewa</a>
<a href="{{ route('gedung.index') }}" type="button" class="btn btn rounded-3">Data Gedung</a>
<a href="{{ route('pesanan.index') }}" type="button" class="btn btn rounded-3">Data Pesanan</a>
<a href="{{ route('login.create') }}" type="button" class="btn btn-danger rounded-3" style="float:right">KELUAR</a>

<h4 class="mt-5">Data Sewa Gedung</h4>
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>Kode Pesanan</th>
            <th>Nama Pemesan</th>
            <th>Kode Gedung</th>
            <th>Lokasi</th>
            <th>Harga</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->kode_order }}</td>
            <td>{{ $data->nama}}</td>
            <td>{{ $data->id_gedung}}</td>
            <td>{{ $data->lokasi}}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->tgl_mulai }}</td>
            <td>{{ $data->tgl_selesai }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop