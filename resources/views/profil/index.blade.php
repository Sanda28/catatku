@extends('layouts.app')

@section('title', 'Profil')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="col-sm-12">
    <div class="card" style="width: 65%">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    @if ($user->image)
                    <img style="width: 300px" src="{{ asset('storage/'. $user->image) }}">
                    @else
                    <img style="width: 250px" src="{{ asset('storage/default.png') }}">
                    @endif
                </div>
                <div class="col-md-7">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td>{{ $user->role }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-end">
                <div class="col-md-6 text-end">
                    <a href="{{ route('profil.edit', Auth::user()) }}" class="btn btn-primary">Edit Profil</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
