@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="col-lg-12">
    <div class="card border-2">
        <div class="card-reader">
        </div>
        <div class="card-body">
            <form action="/user/{{ $user->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="hidden" class="form-control form-control-user @error('id') is-invalid @enderror" id="id" name="id" value="{{ $user->id }}">
                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan Name" value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan Username" value="{{ $user->username }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                                    </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan email" value="{{ $user->email }}">
                        @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control form-control-user" name="role" id="role">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="hidden" name="oldimage" value="{{ $user->image }}">
                        @if ($user->image)
                            <img src="{{ asset('storage/'.$user->image) }}" class="img-preview img-fluid mb-3 col-sm-2 d-block">
                        @else
                            <img class="img-preview img-fluid mb-3 col-sm-2">
                        @endif
                        <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="Update" class="btn btn-success"><i class="fas fa-plus-circle"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        // Periksa apakah ada file yang dipilih
        if (image.files && image.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Tampilkan pratinjau gambar
                imgPreview.style.display = 'block';
                imgPreview.src = e.target.result;
            }

            // Baca file gambar sebagai URL data
            reader.readAsDataURL(image.files[0]);
        } else {
            // Sembunyikan pratinjau gambar jika tidak ada file yang dipilih
            imgPreview.style.display = 'none';
        }
    }
</script>


@endsection
