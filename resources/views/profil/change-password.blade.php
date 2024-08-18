@extends('layouts.app')

@section('title', 'Ganti Password')

@section('content')
    <div class="col-sm-6">
        <div class="card border-2">
            <div class="card-reader">
            </div>
            <div class="card-body">
            <form action="{{ route('profil.changePassword') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                    @error('new_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
            </div>
        </div>
    </div>
@endsection
