<?php
namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    // Menggunakan with('kategori') untuk menghindari N+1 Problem (Efisien)
    public function index()
    {
        $alat = Alat::with('kategori')->latest()->paginate(10);
        return view('dashboard.alat.index', compact('alat'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('dashboard.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
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
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all();
        return view('dashboard.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, $id)
    {
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
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}