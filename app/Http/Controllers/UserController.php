<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.user.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'role' => 'required|in:admin,petugas,peminjam',
        ]);

        // Perbaikan di UserController store()
        User::create([
            'username' => $request->username,
            'email' => $request->email, // TAMBAHKAN INI
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'nama_lengkap' => 'required',
            'role' => 'required|in:admin,petugas,peminjam',
        ]);

        $data = $request->only(['username', 'nama_lengkap', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
