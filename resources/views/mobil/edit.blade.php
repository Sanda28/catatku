@extends('layouts.app')

@section('title', 'Edit Mobil')

@section('content')
<form action="/mobil/{{ $mobil->id }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="nopol">Nopol</label>
            <input type="hidden" class="form-control form-control-user" id="id" name="id" value="{{ $mobil->id }}">
            <input type="text" class="form-control form-control-user @error('nopol') is-invalid @enderror" id="nopol" name="nopol" value="{{ $mobil->nopol }}" placeholder="Masukkan Nopol">
            @error('nopol')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <input type="text" class="form-control form-control-user @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ $mobil->jurusan }}" placeholder="Masukkan jurusan">

            @error('jurusan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="hidden" name="oldimage" value="{{ $mobil->image }}">
            @if ($mobil->image)
                <img src="{{ asset('storage/'.$mobil->image) }}" class="img-preview img-fluid mb-3 col-sm-2 d-block">
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
