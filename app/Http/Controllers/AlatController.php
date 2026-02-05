<?php
namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlatController extends Controller
{
    // Menggunakan with('kategori') untuk menghindari N+1 Problem (Efisien)
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role == 'peminjam') {
            // Peminjam hanya bisa melihat daftar alat (read-only)
            $alat = Alat::with('kategori')->where('stok', '>', 0)->latest()->paginate(10);
            return view('dashboard.alat.index', compact('alat'));
        } else {
            // Admin bisa melihat semua alat
            $alat = Alat::with('kategori')->latest()->paginate(10);
            return view('dashboard.alat.index', compact('alat'));
        }
    }

    public function create()
    {
        $user = Auth::user();
        
        if ($user->role != 'admin') {
            return redirect()->route('alat.index')->with('error', 'Anda tidak memiliki akses untuk menambah alat.');
        }
        
        $kategori = Kategori::all();
        return view('dashboard.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin') {
            return redirect()->route('alat.index')->with('error', 'Anda tidak memiliki akses untuk menambah alat.');
        }
        
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_alat'   => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'stok'        => 'required|integer|min:0',
        ]);

        Alat::create($request->all());

        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function show($id)
    {
        $alat = Alat::with('kategori')->findOrFail($id);
        return view('dashboard.alat.show', compact('alat'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin') {
            return redirect()->route('alat.index')->with('error', 'Anda tidak memiliki akses untuk mengedit alat.');
        }
        
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all();
        return view('dashboard.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin') {
            return redirect()->route('alat.index')->with('error', 'Anda tidak memiliki akses untuk mengedit alat.');
        }
        
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_alat'   => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'stok'        => 'required|integer|min:0',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin') {
            return redirect()->route('alat.index')->with('error', 'Anda tidak memiliki akses untuk menghapus alat.');
        }
        
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}