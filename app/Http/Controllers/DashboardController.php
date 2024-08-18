<?php

namespace App\Http\Controllers;

use App\Models\Bukukas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // Filter bulan dan tahun default
        $bulanIni = Carbon::now()->format('m');
        $tahunIni = Carbon::now()->format('Y');

        // Menghitung saldo akhir dari bukukas
        $saldoAkhir = Bukukas::sum('masuk') - Bukukas::sum('keluar');

        // Mengambil total pemasukan bulan ini
        $totalPemasukanBulanIni = Bukukas::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('masuk');

        // Mengambil total pengeluaran bulan ini
        $totalPengeluaranBulanIni = Bukukas::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('keluar');

        // Mengambil total pemasukan tahun ini
        $totalPemasukanTahunIni = Bukukas::whereYear('tanggal', $tahunIni)
            ->sum('masuk');

        // Mengambil total pengeluaran tahun ini
        $totalPengeluaranTahunIni = Bukukas::whereYear('tanggal', $tahunIni)
            ->sum('keluar');
        // Mengambil data pemasukan dan pengeluaran per bulan
        $data = Bukukas::select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('SUM(masuk) as total_masuk'), DB::raw('SUM(keluar) as total_keluar'))
                        ->groupBy(DB::raw('MONTH(tanggal)'))
                        ->orderBy(DB::raw('MONTH(tanggal)'))
                        ->get();

        return view('dashboard.index', compact('data','saldoAkhir', 'totalPemasukanBulanIni', 'totalPengeluaranBulanIni', 'totalPemasukanTahunIni', 'totalPengeluaranTahunIni'));
    }
}
