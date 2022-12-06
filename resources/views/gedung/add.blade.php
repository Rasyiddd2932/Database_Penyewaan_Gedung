@extends('gedung.layout')

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

        <h5 class="card-title fw-bolder mb-3">Tambah gedung</h5>

		<form method="post" action="{{ route('gedung.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_gedung" class="form-label">ID gedung</label>
                <input type="text" class="form-control" id="id_gedung" name="id_gedung">
            </div>
			<div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi">
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <input type="text" class="form-control" id="tipe" name="tipe">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
			</div>
		</form>
	</div>
</div>

@stop