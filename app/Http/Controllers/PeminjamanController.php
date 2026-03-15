<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'peminjam') {
            $peminjamans = Peminjaman::with(['peminjam', 'alat', 'petugas'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $peminjamans = Peminjaman::with(['peminjam', 'alat', 'petugas'])
                ->latest()
                ->paginate(10);
        }

        return view('dashboard.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role == 'peminjam') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Anda tidak memiliki akses untuk membuat peminjaman langsung. Silakan ajukan peminjaman.');
        }

        $users   = User::where('role', 'peminjam')->get();
        $alats   = Alat::where('stok', '>', 0)->get();
        $petugas = User::whereIn('role', ['admin', 'petugas'])->get();

        return view('dashboard.peminjaman.create', compact('users', 'alats', 'petugas'));
    }

    /**
     * Show form untuk peminjam mengajukan peminjaman.
     */
    public function ajukan()
    {
        $user = Auth::user();

        if ($user->role != 'peminjam') {
            return redirect()->route('peminjaman.create');
        }

        $alats = Alat::where('stok', '>', 0)->get();

        return view('dashboard.peminjaman.ajukan', compact('alats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'peminjam') {
            $request->validate([
                'alat_id'        => 'required|exists:alats,id',
                'tanggal_pinjam' => 'required|date',
                'jumlah'         => 'required|integer|min:1',
                'tanggal_kembali'=> 'required|date|after:tanggal_pinjam',
            ]);

            $alat = Alat::findOrFail($request->alat_id);

            if ($alat->stok < $request->jumlah) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $alat->stok]);
            }

            Peminjaman::create([
                'user_id'        => $user->id,
                'alat_id'        => $request->alat_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'jumlah'         => $request->jumlah,
                'tanggal_kembali'=> $request->tanggal_kembali,
                'status'         => 'dipinjam',
                'id_petugas'     => 1,
            ]);

            $alat->decrement('stok', $request->jumlah);

            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil diajukan dan disetujui otomatis.');
        }

        // Admin / Petugas
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'alat_id'        => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah'         => 'required|integer|min:1',
            'tanggal_kembali'=> 'required|date|after:tanggal_pinjam',
            'id_petugas'     => 'required|exists:users,id',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $alat->stok]);
        }

        Peminjaman::create([
            'user_id'        => $request->user_id,
            'alat_id'        => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jumlah'         => $request->jumlah,
            'tanggal_kembali'=> $request->tanggal_kembali,
            'status'         => 'dipinjam',
            'id_petugas'     => $request->id_petugas,
        ]);

        $alat->decrement('stok', $request->jumlah);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
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
        $user       = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        if ($user->role == 'peminjam') {
            if ($peminjaman->user_id != $user->id) {
                return redirect()->route('peminjaman.index')
                    ->with('error', 'Anda tidak memiliki akses untuk mengedit peminjaman ini.');
            }
            if ($peminjaman->status == 'dikembalikan') {
                return redirect()->route('peminjaman.index')
                    ->with('error', 'Peminjaman yang sudah dikembalikan tidak dapat diedit.');
            }
        }

        $users   = User::where('role', 'peminjam')->get();
        $alats   = Alat::all();
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
            'user_id'        => 'required|exists:users,id',
            'alat_id'        => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah'         => 'required|integer|min:1',
            'tanggal_kembali'=> 'required|date|after:tanggal_pinjam',
            'status'         => 'required|in:dipinjam,dikembalikan,menunggu,disetujui,ditolak',
            'id_petugas'     => 'required|exists:users,id',
        ]);

        // Alat berubah → kembalikan stok lama, kurangi stok baru
        if ($peminjaman->alat_id != $request->alat_id) {
            $oldAlat = Alat::findOrFail($peminjaman->alat_id);
            $oldAlat->increment('stok', $peminjaman->jumlah);

            $newAlat = Alat::findOrFail($request->alat_id);
            if ($newAlat->stok < $request->jumlah) {
                $oldAlat->decrement('stok', $peminjaman->jumlah); // rollback
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $newAlat->stok]);
            }
            $newAlat->decrement('stok', $request->jumlah);

        } elseif ($peminjaman->jumlah != $request->jumlah) {
            // Hanya jumlah berubah
            $alat       = Alat::findOrFail($peminjaman->alat_id);
            $difference = $request->jumlah - $peminjaman->jumlah;

            if ($difference > 0 && $alat->stok < $difference) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . ($alat->stok + $peminjaman->jumlah)]);
            }
            $alat->decrement('stok', $difference);
        }

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user       = Auth::user();
        $peminjaman = Peminjaman::findOrFail($id);

        if ($user->role == 'peminjam') {
            if ($peminjaman->user_id != $user->id) {
                return redirect()->route('peminjaman.index')
                    ->with('error', 'Anda tidak memiliki akses untuk menghapus peminjaman ini.');
            }
            if ($peminjaman->status == 'dikembalikan') {
                return redirect()->route('peminjaman.index')
                    ->with('error', 'Peminjaman yang sudah dikembalikan tidak dapat dihapus.');
            }
        }

        // Kembalikan stok jika masih dipinjam
        if ($peminjaman->status == 'dipinjam') {
            $alat = Alat::findOrFail($peminjaman->alat_id);
            $alat->increment('stok', $peminjaman->jumlah);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }

    /**
     * Approve peminjaman (admin/petugas only).
     */
    public function approve($id)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['admin', 'petugas'])) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Anda tidak memiliki akses untuk menyetujui peminjaman.');
        }

        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status != 'menunggu') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman sudah diproses sebelumnya.');
        }

        $peminjaman->update(['status' => 'disetujui']);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil disetujui.');
    }

    /**
     * Reject / batalkan peminjaman (admin/petugas only).
     */
    public function reject($id)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['admin', 'petugas'])) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Anda tidak memiliki akses untuk menolak peminjaman.');
        }

        $peminjaman = Peminjaman::findOrFail($id);

        if (!in_array($peminjaman->status, ['menunggu', 'dipinjam'])) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman sudah diproses sebelumnya.');
        }

        $peminjaman->update(['status' => 'ditolak']);

        // Kembalikan stok jika sudah dipinjam
        if ($peminjaman->status == 'dipinjam') {
            $alat = Alat::findOrFail($peminjaman->alat_id);
            $alat->increment('stok', $peminjaman->jumlah);
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibatalkan.');
    }
}
