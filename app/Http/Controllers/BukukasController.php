<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bukukas;
use App\Models\Mobil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BukukasController extends Controller
{
    public function index()
    {
        $bukukas = Bukukas::with(['user', 'mobil'])
                ->orderBy('tanggal', 'desc')
                ->paginate(15);

        $mobil = Mobil::all();

        return view('bukukas.index', compact('bukukas', 'mobil'));
    }
    public function storeMasuk(Request $request)
    {
        $validatedData = $request->validate([
            'masuk' => 'required',
            'uraian' => 'required|max:255',
            'mobil_id' => 'required',
            'tanggal' => 'required',
        ]);
        $validatedData['user_id'] = Auth::id();
        Bukukas::create($validatedData);

        return redirect('/bukukas')->with('success', 'Buku Kas masuk ditambahkan');
    }

    public function storeKeluar(Request $request)
    {
        $validatedData = $request->validate([
            'keluar' => 'required',
            'uraian' => 'required|max:255',
            'mobil_id' => 'required',
            'tanggal' => 'required',
        ]);

        $validatedData['user_id'] = Auth::id();
        Bukukas::create($validatedData);

        return redirect('/bukukas')->with('success', 'Data keluar berhasil ditambahkan');
    }
    public function destroy(Bukukas $bukukas)
    {
        Bukukas::destroy($bukukas->id);
        return redirect()->route('bukukas.index')->with('success','Data dihapus');
    }
    public function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}
