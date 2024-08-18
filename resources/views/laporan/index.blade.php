@extends('layouts.app')

@section('title', 'Laporan Bulanan')

@section('content')
<div class="col-lg-6">
    <div class="card border-2">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ route('laporan.index') }}" method="GET" class="row">
                <div class="form-group col-md-4">
                    <label for="bulan" class="col-form-label">Pilih Bulan:</label>
                    <select class="form-control form-control-user" name="bulan" id="bulan">
                        <option value="01" {{ $bulan == '01' ? 'selected' : '' }}>Januari</option>
                        <option value="02" {{ $bulan == '02' ? 'selected' : '' }}>Februari</option>
                        <option value="03" {{ $bulan == '03' ? 'selected' : '' }}>Maret</option>
                        <option value="04" {{ $bulan == '04' ? 'selected' : '' }}>April</option>
                        <option value="05" {{ $bulan == '05' ? 'selected' : '' }}>Mei</option>
                        <option value="06" {{ $bulan == '06' ? 'selected' : '' }}>Juni</option>
                        <option value="07" {{ $bulan == '07' ? 'selected' : '' }}>Juli</option>
                        <option value="08" {{ $bulan == '08' ? 'selected' : '' }}>Agustus</option>
                        <option value="09" {{ $bulan == '09' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="tahun" class="col-form-label">Pilih Tahun:</label>
                    <select class="form-control form-control-user" name="tahun" id="tahun">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="mobil_id" class="col-form-label">Pilih Mobil:</label>
                    <select class="form-control form-control-user" name="mobil_id" id="mobil_id">
                        <option value="">Semua</option>
                        @foreach($mobils as $mobil)
                            <option value="{{ $mobil->id }}" {{ $mobil_id == $mobil->id ? 'selected' : '' }}>{{ $mobil->nopol }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(isset($bukukas))
<div class="col-lg-12 mt-4">
    <div class="card border-2">
        <div class="card-header bg-transparent border-2">
            <div class="d-flex justify-content-between">
                <h5 class="mb-0">Laporan Bukukas</h5>
                <div>
                    <a href="{{ route('laporan.buatPDF', ['bulan' => $bulan, 'tahun' => $tahun, 'mobil_id' => $mobil_id]) }}" class="btn btn-danger">Download PDF</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Mobil</th>
                            <th>Uraian</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalMasuk = 0;
                            $totalKeluar = 0;
                        @endphp
                        @foreach($bukukas as $index => $buku)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($buku->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $buku->mobil->nopol }}</td>
                            <td>{{ $buku->uraian }}</td>
                            <td>{{ app('App\Http\Controllers\BukukasController')->formatRupiah($buku->masuk) }}</td>
                            <td>{{ app('App\Http\Controllers\BukukasController')->formatRupiah($buku->keluar) }}</td>
                            @php
                                $totalMasuk += $buku->masuk;
                                $totalKeluar += $buku->keluar;
                            @endphp
                        </tr>
                        @endforeach
                        @php
                            $saldoAkhir = $totalMasuk - $totalKeluar;
                        @endphp
                        <tr>
                            <td colspan="4"><strong>Saldo Akhir</strong></td>
                            <td colspan="2">{{ app('App\Http\Controllers\BukukasController')->formatRupiah($saldoAkhir) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
