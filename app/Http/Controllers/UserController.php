<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::paginate(10);
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah Data',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:8|max:255',
            'role' => 'required|in:admin,owner,user',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('user-images');
        }

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);
        return redirect('/user')->with('success', 'User ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', [
            'title' => 'Detail',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'title' => 'Edit Data',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email:dns|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,owner,user',
            'image' => 'image|file|max:1024',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($user->image) {
                Storage::delete($user->image);
            }

            $validatedData['image'] = $request->file('image')->store('user-images');
        }

        $user->update($validatedData);

        return redirect('/user')->with('success', 'Informasi pengguna telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::delete($user->image);
        }

        User::destroy($user->id);
        return redirect('/user')->with('success', 'User dihapus');
    }
}
