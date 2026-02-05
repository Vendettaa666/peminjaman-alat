<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'alat_id',
        'tanggal_pinjam',
        'jumlah',
        'tanggal_kembali',
        'status',
        'id_petugas',
    ];

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }
    
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
}
