<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bukukas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Bukukas</h2>
    @if ($mobil_id)
        <p>Nopol: {{ $mobils->where('id', $mobil_id)->first()->nopol }}</p>
    @endif
    <table>
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
                <td colspan="4">Saldo Akhir</td>
                <td colspan="2">{{ app('App\Http\Controllers\BukukasController')->formatRupiah($saldoAkhir) }}</td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
