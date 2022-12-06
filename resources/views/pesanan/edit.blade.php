@extends('pesanan.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Pesanan</h5>

		<form method="post" action="{{ route('pesanan.update', $data->kode_order) }}">
			@csrf
            <div class="mb-3">
                <label for="id_penyewa" class="form-label">ID Penyewa</label>
                <input type="text" class="form-control" id="id_penyewa" name="id_penyewa" value="{{ $data->id_penyewa }}">
            </div>
            <div class="mb-3">
                <label for="id_gedung" class="form-label">ID gedung</label>
                <input type="text" class="form-control" id="id_gedung" name="id_gedung" value="{{ $data->id_gedung }}">
            </div>
			<div class="mb-3">
                <label for="kode_order" class="form-label">Kode Pesanan</label>
                <input type="text" class="form-control" id="kode_order" name="kode_order" value="{{ $data->kode_order}}">
            </div>
            <div class="mb-3">
                <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="{{ $data->tgl_mulai }}">
            </div>
            <div class="mb-3">
                <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="{{ $data->tgl_selesai }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Edit" />
            </div>
			</div>
		</form>
	</div>
</div>

@stop