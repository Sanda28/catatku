@extends('layouts.app')

@section('title', 'User')

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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahUser">
                Tambah data
            </button>
            <hr class="border-0">
            <div class="table-responsive">
                <table class="table table-striped table-sm" id="">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Image</th>
                        <th scope="col">Pilihan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($user as $u)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->username }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->role }}</td>
                        <td>
                            @if ($u->image)
                                <img src="{{ asset('storage/' . $u->image) }}"class="col-sm-2">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="/user/{{ $u->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                            <form action="/user/{{ $u->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')"><i class="fas fa-times-circle"></i></button>
                            </form>
                        </td>

                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  <div class="pagination">
                    {{ $user->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan Name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                                    </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}">
                        @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password" value="{{ old('password') }}">
                        @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control form-control-user" name="role" id="role">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="owner">Owner</option>
                            <option value="user">User</option>
                        </select>
                        @error('role')
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
