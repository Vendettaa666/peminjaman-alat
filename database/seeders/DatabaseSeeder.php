<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use App\Models\Pengembalian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        $this->seedUsers();
        
        // Seed Kategori
        $this->seedKategori();
        
        // Seed Alat
        $this->seedAlat();
        
        // Seed Peminjaman
        $this->seedPeminjaman();
        
        // Seed Pengembalian
        $this->seedPengembalian();
        
        // Seed Log Aktivitas
        $this->seedLogAktivitas();
    }

    private function seedUsers()
    {
        // Admin
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'nama_lengkap' => 'Administrator',
            'role' => 'admin',
            'password' => Hash::make('123'),
        ]);

        // Petugas
        User::create([
            'username' => 'petugas1',
            'email' => 'petugas1@gmail.com',
            'nama_lengkap' => 'Petugas Satu',
            'role' => 'petugas',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'username' => 'petugas2',
            'email' => 'petugas2@gmail.com',
            'nama_lengkap' => 'Petugas Dua',
            'role' => 'petugas',
            'password' => Hash::make('123'),
        ]);

        // Peminjam
        User::create([
            'username' => 'peminjam1',
            'email' => 'peminjam1@gmail.com',
            'nama_lengkap' => 'John Doe',
            'role' => 'peminjam',
            'password' => Hash::make('123'),
        ]);

        User::create([
            'username' => 'peminjam2',
            'email' => 'peminjam2@gmail.com',
            'nama_lengkap' => 'Jane Smith',
            'role' => 'peminjam',
            'password' => Hash::make('123'),
        ]);
    }

    private function seedKategori()
    {
        $kategoris = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Olahraga'],
            ['nama_kategori' => 'Musik'],
            ['nama_kategori' => 'Fotografi'],
            ['nama_kategori' => 'Komputer'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }

    private function seedAlat()
    {
        $alats = [
            // Elektronik
            ['kategori_id' => 1, 'nama_alat' => 'Laptop ASUS', 'deskripsi' => 'Laptop untuk keperluan kerja dan presentasi', 'stok' => 5],
            ['kategori_id' => 1, 'nama_alat' => 'Proyektor Epson', 'deskripsi' => 'Proyektor untuk presentasi', 'stok' => 3],
            ['kategori_id' => 1, 'nama_alat' => 'Speaker Bluetooth', 'deskripsi' => 'Speaker portable untuk acara', 'stok' => 8],
            
            // Olahraga
            ['kategori_id' => 2, 'nama_alat' => 'Bola Sepak', 'deskripsi' => 'Bola sepak standar FIFA', 'stok' => 10],
            ['kategori_id' => 2, 'nama_alat' => 'Raket Badminton', 'deskripsi' => 'Raket badminton profesional', 'stok' => 6],
            
            // Musik
            ['kategori_id' => 3, 'nama_alat' => 'Gitar Akustik', 'deskripsi' => 'Gitar akustik untuk latihan', 'stok' => 4],
            ['kategori_id' => 3, 'nama_alat' => 'Keyboard Yamaha', 'deskripsi' => 'Keyboard elektronik 61 keys', 'stok' => 2],
            
            // Fotografi
            ['kategori_id' => 4, 'nama_alat' => 'Kamera Canon DSLR', 'deskripsi' => 'Kamera DSLR untuk fotografi', 'stok' => 3],
            ['kategori_id' => 4, 'nama_alat' => 'Tripod Manfrotto', 'deskripsi' => 'Tripod profesional untuk kamera', 'stok' => 5],
            
            // Komputer
            ['kategori_id' => 5, 'nama_alat' => 'Mouse Wireless', 'deskripsi' => 'Mouse wireless ergonomis', 'stok' => 15],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }
    }

    private function seedPeminjaman()
    {
        $peminjamans = [
            [
                'user_id' => 4, // peminjam1
                'alat_id' => 1, // Laptop ASUS
                'tanggal_pinjam' => '2026-02-01',
                'tanggal_kembali' => '2026-02-05',
                'jumlah' => 1,
                'status' => 'dipinjam',
                'id_petugas' => 2, // petugas1
            ],
            [
                'user_id' => 5, // peminjam2
                'alat_id' => 2, // Proyektor Epson
                'tanggal_pinjam' => '2026-01-28',
                'tanggal_kembali' => '2026-02-02',
                'jumlah' => 1,
                'status' => 'dikembalikan',
                'id_petugas' => 2, // petugas1
            ],
            [
                'user_id' => 4, // peminjam1
                'alat_id' => 4, // Bola Sepak
                'tanggal_pinjam' => '2026-02-06',
                'tanggal_kembali' => '2026-02-10',
                'jumlah' => 2,
                'status' => 'dipinjam',
                'id_petugas' => 2, // petugas1
            ],
            [
                'user_id' => 5, // peminjam2
                'alat_id' => 8, // Kamera Canon DSLR
                'tanggal_pinjam' => '2026-02-03',
                'tanggal_kembali' => '2026-02-08',
                'jumlah' => 1,
                'status' => 'dipinjam',
                'id_petugas' => 3, // petugas2
            ],
            [
                'user_id' => 4, // peminjam1
                'alat_id' => 6, // Gitar Akustik
                'tanggal_pinjam' => '2026-02-04',
                'tanggal_kembali' => '2026-02-07',
                'jumlah' => 1,
                'status' => 'dikembalikan',
                'id_petugas' => 2, // petugas1
            ],
        ];

        foreach ($peminjamans as $peminjaman) {
            Peminjaman::create($peminjaman);
        }

        // Update stok alat yang sudah dipinjam (hanya yang status dipinjam)
        Alat::find(1)->decrement('stok', 1); // Laptop ASUS
        Alat::find(4)->decrement('stok', 2); // Bola Sepak
        Alat::find(8)->decrement('stok', 1); // Kamera Canon DSLR
    }

    private function seedPengembalian()
    {
        // Buat pengembalian untuk peminjaman yang sudah dikembalikan
        $pengembalians = [
            [
                'peminjaman_id' => 2, // Proyektor Epson yang sudah dikembalikan
                'tanggal_kembali' => '2026-02-02',
                // 'denda' => 0,
                'kondisi_alat' => 'baik',
            ],
            [
                'peminjaman_id' => 5, // Gitar Akustik yang sudah dikembalikan
                'tanggal_kembali' => '2026-02-07',
                // 'denda' => 5000,
                'kondisi_alat' => 'rusak ringan',
            ],
        ];

        foreach ($pengembalians as $pengembalian) {
            Pengembalian::create($pengembalian);
        }
    }

    private function seedLogAktivitas()
    {
        $logAktivitas = [
            [
                'user_id' => 1, // admin
                'aktivitas' => 'Login ke sistem sebagai administrator',
            ],
            [
                'user_id' => 2, // petugas1
                'aktivitas' => 'Menyetujui peminjaman laptop untuk John Doe',
            ],
            [
                'user_id' => 4, // peminjam1
                'aktivitas' => 'Mengajukan peminjaman bola sepak',
            ],
            [
                'user_id' => 3, // petugas2
                'aktivitas' => 'Menyetujui peminjaman kamera DSLR untuk Jane Smith',
            ],
            [
                'user_id' => 5, // peminjam2
                'aktivitas' => 'Mengembalikan proyektor Epson dalam kondisi baik',
            ],
        ];

        foreach ($logAktivitas as $log) {
            LogAktivitas::create($log);
        }
    }
}