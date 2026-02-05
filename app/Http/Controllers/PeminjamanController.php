<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['peminjam', 'alat', 'petugas'])->get();
        return view('dashboard.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::where('stok', '>', 0)->get();
        $petugas = User::whereIn('role', ['admin', 'petugas'])->get();
        return view('dashboard.peminjaman.create', compact('users', 'alats', 'petugas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'id_petugas' => 'required|exists:users,id',
        ]);

        // Check if stock is sufficient
        $alat = Alat::find($request->alat_id);
        if ($alat->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $alat->stok]);
        }

        // Create peminjaman
        Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jumlah' => $request->jumlah,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
            'id_petugas' => $request->id_petugas,
        ]);

        // Update stock
        $alat->decrement('stok', $request->jumlah);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['peminjam', 'alat', 'petugas'])->findOrFail($id);
        return view('dashboard.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::all();
        $petugas = User::whereIn('role', ['admin', 'petugas'])->get();
        return view('dashboard.peminjaman.edit', compact('peminjaman', 'users', 'alats', 'petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'status' => 'required|in:dipinjam,dikembalikan',
            'id_petugas' => 'required|exists:users,id',
        ]);

        // If alat changed, restore old stock and check new stock
        if ($peminjaman->alat_id != $request->alat_id) {
            $oldAlat = Alat::find($peminjaman->alat_id);
            $oldAlat->increment('stok', $peminjaman->jumlah);
            
            $newAlat = Alat::find($request->alat_id);
            if ($newAlat->stok < $request->jumlah) {
                $oldAlat->decrement('stok', $peminjaman->jumlah);
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $newAlat->stok]);
            }
            $newAlat->decrement('stok', $request->jumlah);
        } elseif ($peminjaman->jumlah != $request->jumlah) {
            // If quantity changed
            $alat = Alat::find($peminjaman->alat_id);
            $difference = $request->jumlah - $peminjaman->jumlah;
            if ($difference > 0 && $alat->stok < $difference) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . ($alat->stok + $peminjaman->jumlah)]);
            }
            $alat->decrement('stok', $difference);
        }

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Restore stock
        $alat = Alat::find($peminjaman->alat_id);
        $alat->increment('stok', $peminjaman->jumlah);
        
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}
