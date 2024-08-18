@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="col-sm-12">
    <div class="card" style="width: 65%">
        <div class="card-body">
            <form action="{{ route('profil.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }} " readonly style="background-color: #f2f2f2;">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly style="background-color: #f2f2f2;">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}" readonly style="background-color: #f2f2f2;">
                </div>
                <div class="mb-3">
                    <img src="{{ asset('storage/'. $user->image) }}" class="img-preview" alt="Preview Image" style="display: none; width: 150px;">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Profil</label>
                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
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
