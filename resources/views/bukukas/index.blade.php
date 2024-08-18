@extends('layouts.app')

@section('title', 'Buku Kas')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-lg-12">
        <div class="card border-2">
            <div class="card-reader"></div>
            <div class="card-body">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#masukBukukas">
                    Masuk
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#keluarBukukas">
                    Keluar
                </button>
            </div>
            <div class="card-body">
                <div class="btn-group mb-3" role="group" aria-label="Filter Mobil">
                    <button type="button" class="btn btn-primary active" onclick="filterBukuKas('')">
                        <i class="fas fa-car"></i> Semua Mobil
                    </button>
                    @foreach($mobil as $m)
                        <button type="button" class="btn btn-outline-secondary" onclick="filterBukuKas('{{ $m->id }}')">
                            <i class="fas fa-car-side"></i> {{ $m->nopol }}
                        </button>
                    @endforeach
                </div>

                <!-- Tabel Buku Kas -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Uraian</th>
                                <th scope="col">Masuk</th>
                                <th scope="col">Keluar</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pilihan</th>
                            </tr>
                        </thead>
                        <tbody id="bukuKasBody">
                            @foreach ($bukukas as $buku)
                                <tr data-mobil="{{ $buku->mobil_id }}">
                                    <td data-label="#">{{ $loop->iteration }}</td>
                                    <td data-label="User">{{ $buku->user->username }}</td>
                                    <td data-label="Mobil">{{ $buku->mobil->nopol }}</td>
                                    <td data-label="Uraian">{{ $buku->uraian }}</td>
                                    <td data-label="Masuk">{{ app('App\Http\Controllers\BukukasController')->formatRupiah($buku->masuk) }}</td>
                                    <td data-label="Keluar">{{ app('App\Http\Controllers\BukukasController')->formatRupiah($buku->keluar) }}</td>
                                    <td data-label="Tanggal">{{ \Carbon\Carbon::parse($buku->tanggal)->format('d/m/Y') }}</td>
                                    <td data-label="Pilihan">
                                        @if (auth()->user()->isAdmin() || auth()->user()->id == $buku->user_id)
                                            <form action="/bukukas/{{ $buku->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-dark btn-sm" onclick="return confirm('Anda Tidak Memiliki Akses')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $bukukas->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for filtering -->
    <script>
        function filterBukuKas(mobilId) {
            var rows = document.querySelectorAll('#bukuKasBody tr');
            rows.forEach(function(row) {
                if (mobilId === "" || row.getAttribute('data-mobil') === mobilId) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="keluarBukukas" tabindex="-1" aria-labelledby="keluarBukukasLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Keluar Buku Kas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bukukas.storeKeluar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="mobil_id">Mobil</label>
                        <select class="form-control form-control-user" name="mobil_id">
                            <option>-- Pilih Mobil --</option>
                            @foreach ($mobil as $m)
                            <option value="{{ $m->id }}">{{ $m->nopol }}</option>
                            @endforeach
                        </select>
                        @error('mobil_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="keluar">Jumlah</label>
                        <input type="text" class="form-control form-control-user @error('keluar') is-invalid @enderror" id="keluar" name="keluar" placeholder="Masukkan Keluar">
                        @error('keluar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="uraian">Uraian</label>
                        <textarea class="form-control form-control-user @error('uraian') is-invalid @enderror" id="uraian" name="uraian" placeholder="Masukkan Uraian" style="height: 100px">{{ old('uraian') }}</textarea>
                        @error('uraian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
@endsection
