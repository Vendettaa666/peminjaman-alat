<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alats';

protected $fillable = [
    'kategori_id', // Sesuaikan dengan nama di DB (kategori_id)
    'nama_alat',
    'deskripsi',
    'stok'
];

// Pastikan relasi juga menggunakan foreign key yang benar
public function kategori()
{
    return $this->belongsTo(Kategori::class, 'kategori_id');
}
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'alat_id');
    }
}
