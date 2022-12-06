@extends('penyewa.layout')

@section('content')
<a href="{{ route('home.index') }}" type="button" class="btn btn rounded-3">Home</a>
<a href="{{ route('penyewa.index') }}" type="button" class="btn btn rounded-3">Data Penyewa</a>
<a href="{{ route('gedung.index') }}" type="button" class="btn btn rounded-3">Data Gedung</a>
<a href="{{ route('pesanan.index') }}" type="button" class="btn btn rounded-3">Data Pesanan</a>
<a href="{{ route('login.create') }}" type="button" class="btn btn-danger rounded-3" style="float:right">KELUAR</a>

<h4 class="mt-5">Trash Penyewa</h4>

<a href="{{ route('penyewa.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data Penyewa</a>

<div class="form-search" style="float:right">
    <form action="{{ route('penyewa.search_trash') }}" method="get" accept-charset="utf-8">
        <div class="form-group" style="display:flex">
            <input type="search" id="nama" name="nama" class="form-control" placeholder="Cari Penyewa">
            <button type="submit" class="btn btn-secondary">Search</button>
    </form>
</div>
</div>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<div style="margin-top: 20px">
    <div style="margin-bottom: +45px">
        <div>
            <a class="btn btn-outline-primary btn-sm" href="{{ route('penyewa.index') }}" type="button">Data penyewa</a>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('penyewa.trash') }}" type="button">Trash</a>
        </div>
    </div>
</div>


<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID Penyewa</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Dihapus Pada</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_penyewa }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->deleted_at }}</td>
            <td>
                <a href="{{ route('penyewa.restore', $data->id_penyewa) }}" type="button"
                    class="btn btn-success rounded-3">Restore</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->id_penyewa }}">
                    Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->id_penyewa }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('penyewa.delete', $data->id_penyewa) }}">
                                @csrf
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop