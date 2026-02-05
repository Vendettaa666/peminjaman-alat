<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role == 'peminjam') {
            // Peminjam hanya bisa melihat pengembalian mereka sendiri
            $pengembalians = Pengembalian::with(['peminjaman.peminjam', 'peminjaman.alat'])
                ->whereHas('peminjaman', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        } else {
            // Admin dan petugas bisa melihat semua pengembalian
            $pengembalians = Pengembalian::with(['peminjaman.peminjam', 'peminjaman.alat'])->get();
        }
        
        return view('dashboard.pengembalian.index', compact('pengembalians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        
        if ($user->role == 'peminjam') {
            // Peminjam bisa mengajukan pengembalian untuk peminjaman mereka sendiri
            $peminjamans = Peminjaman::with(['peminjam', 'alat'])
                ->where('status', 'dipinjam')
                ->where('user_id', $user->id)
                ->whereDoesntHave('pengembalian')
                ->get();
        } else {
            // Admin dan petugas bisa memproses semua pengembalian
            $peminjamans = Peminjaman::with(['peminjam', 'alat'])
                ->where('status', 'dipinjam')
                ->whereDoesntHave('pengembalian')
                ->get();
        }
        
        return view('dashboard.pengembalian.create', compact('peminjamans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date',
            'denda' => 'nullable|numeric|min:0',
            'kondisi_alat' => 'required|in:baik,rusak ringan,rusak berat',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        
        // Cek akses untuk peminjam
        if ($user->role == 'peminjam' && $peminjaman->user_id != $user->id) {
            return redirect()->route('pengembalian.index')->with('error', 'Anda tidak memiliki akses untuk mengembalikan peminjaman ini.');
        }
        
        // Create pengembalian
        Pengembalian::create($request->all());
        
        // Update peminjaman status
        $peminjaman->update(['status' => 'dikembalikan']);
        
        // Return stock to alat
        $alat = Alat::find($peminjaman->alat_id);
        $alat->increment('stok', $peminjaman->jumlah);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengembalian = Pengembalian::with(['peminjaman.peminjam', 'peminjaman.alat', 'peminjaman.petugas'])->findOrFail($id);
        return view('dashboard.pengembalian.show', compact('pengembalian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjamans = Peminjaman::with(['peminjam', 'alat'])->get();
        return view('dashboard.pengembalian.edit', compact('pengembalian', 'peminjamans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date',
            'denda' => 'nullable|numeric|min:0',
            'kondisi_alat' => 'required|in:baik,rusak ringan,rusak berat',
        ]);

        $pengembalian->update($request->all());

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        
        // Update peminjaman status back to dipinjam
        $peminjaman = Peminjaman::find($pengembalian->peminjaman_id);
        $peminjaman->update(['status' => 'dipinjam']);
        
        // Remove stock from alat
        $alat = Alat::find($peminjaman->alat_id);
        $alat->decrement('stok', $peminjaman->jumlah);
        
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dihapus');
    }
}
