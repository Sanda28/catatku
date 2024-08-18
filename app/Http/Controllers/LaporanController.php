<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bukukas;
use App\Models\Mobil;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $mobil_id = $request->mobil_id ?? null;

        $bukukasQuery = Bukukas::whereMonth('tanggal', $bulan)
                                ->whereYear('tanggal', $tahun);

        if ($mobil_id) {
            $bukukasQuery->where('mobil_id', $mobil_id);
        }

        $bukukas = $bukukasQuery->get();

        // Mendapatkan semua data mobil
        $mobils = Mobil::all();

        return view('laporan.index', compact('bukukas', 'bulan', 'tahun', 'mobils', 'mobil_id'));
    }

    public function buatPDF(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $mobil_id = $request->mobil_id;

        $bukukas = Bukukas::whereMonth('tanggal', $bulan)
                        ->whereYear('tanggal', $tahun)
                        ->when($mobil_id, function ($query, $mobil_id) {
                                return $query->where('mobil_id', $mobil_id);
                            })
                        ->get();

        $mobils = Mobil::all();

        $pdf = PDF::loadView('laporan.pdf', compact('bukukas', 'bulan', 'tahun', 'mobils','mobil_id'));
        return $pdf->download('laporan-bukukas-'.$bulan.'-'.$tahun.'.pdf');
    }
}
