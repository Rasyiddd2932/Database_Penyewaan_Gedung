@extends('login.layout')
@section('content')
<div class="card mt-4">
@if($message = Session::get('danger'))
<div class="alert alert-danger mt-3" role="alert" >
    {{ $message }}
</div>
@endif
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Login</h5>
        <form method="get" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username"/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password"/>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="MASUK" />
            </div>
        </form>
    </div>
</div>
@stop