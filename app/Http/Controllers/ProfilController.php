<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profil.edit',[
            'title' => 'Edit Data',
            'user' => $user,
        ]);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }

            $imagePath = $request->file('image')->store('user-img');
            $user->image = str_replace('public/', '', $imagePath);
        }

        $user->save();
        return redirect()->route('profil.index', ['profil' => $user->id])->with('success', 'Profil berhasil diperbarui');
    }
    public function changePasswordForm()
    {
        $user = Auth::user();
        return view('profil.change-password', compact('user'));
    }

    // Metode untuk memproses perubahan password
    public function changePassword(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|max:255|confirmed',
        ]);

        // Dapatkan data pengguna yang terautentikasi
        $user = Auth::user();

        // Periksa apakah password yang dimasukkan saat ini sesuai dengan password user
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        // Update password user dengan password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profil.index')->with('success', 'Password berhasil diubah.');
    }
}
