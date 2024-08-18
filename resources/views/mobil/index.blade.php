@extends('layouts.app')

@section('title', 'Mobil')

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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahMobil">
                Tambah data
            </button>
            <hr class="border-0">
            <div class="table-responsive">
                <table class="table table-striped table-sm" id="mobil">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nopol</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Image</th>
                        <th scope="col">Pilihan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($mobil as $m)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->nopol }}</td>
                        <td>{{ $m->jurusan }}</td>
                        <td>
                            @if ($m->image)
                                <img src="{{ asset('storage/' . $m->image) }}" alt="Image" class="col-sm-2">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="/mobil/{{ $m->id }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="/mobil/{{ $m->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                            <form action="/mobil/{{ $m->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                </table>
                <div class="pagination">
                    {{ $mobil->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahMobil" tabindex="-1" aria-labelledby="tambahMobilLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Mobil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/mobil" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nopol">Nopol</label>
                        <input type="text" class="form-control form-control-user @error('nopol') is-invalid @enderror" id="nopol" name="nopol" placeholder="Masukkan Nopol" value="{{ old('nopol') }}">
                        @error('nopol')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control form-control-user @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" placeholder="Masukkan jurusan" value="{{ old('jurusan') }}">
                        @error('jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                        @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <hr class="border-0">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                    </div>
            </form>
        </div>
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
