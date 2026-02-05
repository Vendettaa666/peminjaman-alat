<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logAktivitas = LogAktivitas::with('user')->orderBy('created_at', 'desc')->get();
        return view('dashboard.log_aktivitas.index', compact('logAktivitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard.log_aktivitas.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'aktivitas' => 'required|string|max:255',
        ]);

        LogAktivitas::create($request->all());

        return redirect()->route('log_aktivitas.index')->with('success', 'Log aktivitas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $logAktivitas = LogAktivitas::with('user')->findOrFail($id);
        return view('dashboard.log_aktivitas.show', compact('logAktivitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $logAktivitas = LogAktivitas::findOrFail($id);
        $users = User::all();
        return view('dashboard.log_aktivitas.edit', compact('logAktivitas', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $logAktivitas = LogAktivitas::findOrFail($id);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'aktivitas' => 'required|string|max:255',
        ]);

        $logAktivitas->update($request->all());

        return redirect()->route('log_aktivitas.index')->with('success', 'Log aktivitas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $logAktivitas = LogAktivitas::findOrFail($id);
        $logAktivitas->delete();

        return redirect()->route('log_aktivitas.index')->with('success', 'Log aktivitas berhasil dihapus');
    }
}
