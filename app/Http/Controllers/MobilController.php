<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobil = Mobil::paginate(10);
        return view('mobil.index', compact('mobil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mobil.tambah',[
            'title' => 'Tambah Data',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nopol' => 'required|max:255',
            'jurusan' => 'required|max:255',
            'image' => 'image|file|max:2048'
        ]);
        if($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('mobil-img');
        }

        Mobil::create($validateData);
        return redirect('/mobil')->with('success','Mobil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $mobil)
    {
        return view('mobil.detail', [
            'title' => 'Detail',
            'mobil' =>  $mobil,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobil $mobil)
    {
        return view('mobil.edit',[
            'title' => 'Edit Data',
            'mobil' => $mobil,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mobil $mobil)
    {
        $validatedData = $request->validate([
            'nopol' => 'required|max:255',
            'jurusan' => 'required|max:255',
            'image' => 'image|file|max:2048'
        ]);

        if ($request->file('image')) {
            if ($request->oldimage) {
                Storage::delete($request->oldimage);
            }

            $validatedData['image'] = $request->file('image')->store('mobil-img');
        }

        Mobil::where('id', $mobil->id)->update($validatedData);

        $mobil = Mobil::findOrFail($mobil->id);

        return redirect('/mobil')->with('success', 'Mobil has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
        if ($mobil->image) {
            Storage::delete($mobil->image);
        }
        //dd($mobil);
        Mobil::destroy($mobil->id);
        return redirect('/mobil')->with('success','Mobil dihapus');
    }
}
