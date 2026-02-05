<aside>
    <div class="w-64 h-screen bg-gray-800 p-4 text-white flex flex-col">
        <h1 class="text-xl font-bold p-4 text-center border-b border-gray-600 mb-4">
            Peminjaman Alat
        </h1>

        <div class="mb-4 p-3 bg-gray-700 rounded">
            <p class="text-sm text-gray-300">Selamat datang,</p>
            <p class="font-semibold">{{ Auth::user()->nama_lengkap }}</p>
            <span class="inline-block px-2 py-1 text-xs rounded mt-1 
                {{ Auth::user()->role == 'admin' ? 'bg-red-600' : (Auth::user()->role == 'petugas' ? 'bg-green-600' : 'bg-blue-600') }}">
                {{ ucfirst(Auth::user()->role) }}
            </span>
        </div>

        <ul class="space-y-2 flex-1 overflow-y-auto">
            <!-- Menu untuk semua role -->
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-home mr-3"></i>
                    Dashboard
                </a>
            </li>

            @if(Auth::user()->role == 'admin')
                <!-- Menu khusus Admin -->
                <li class="pt-2"></li>
                    <p class="px-4 py-1 text-xs text-gray-400 uppercase tracking-wide">Manajemen Data</p>
                </li>
                <li>
                    <a href="{{ route('user.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-users mr-3"></i>
                        Kelola User
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategori.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-tags mr-3"></i>
                        Kelola Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ route('alat.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-tools mr-3"></i>
                        Kelola Alat
                    </a>
                </li>
                <li>
                    <a href="{{ route('peminjaman.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-handshake mr-3"></i>
                        Data Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengembalian.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-undo mr-3"></i>
                        Data Pengembalian
                    </a>
                </li>
                <li>
                    <a href="{{ route('log_aktivitas.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-clipboard-list mr-3"></i>
                        Log Aktivitas
                    </a>
                </li>

            @elseif(Auth::user()->role == 'petugas')
                <!-- Menu khusus Petugas -->
                <li class="pt-2">
                    <p class="px-4 py-1 text-xs text-gray-400 uppercase tracking-wide">Tugas Petugas</p>
                </li>
                <li>
                    <a href="{{ route('peminjaman.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-handshake mr-3"></i>
                        Setujui Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengembalian.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-undo mr-3"></i>
                        Pantau Pengembalian
                    </a>
                </li>
                <li>
                    <a href="{{ route('alat.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-eye mr-3"></i>
                        Lihat Daftar Alat
                    </a>
                </li>

            @else
                <!-- Menu khusus Peminjam -->
                <li class="pt-2">
                    <p class="px-4 py-1 text-xs text-gray-400 uppercase tracking-wide">Menu Peminjam</p>
                </li>
                <li>
                    <a href="{{ route('alat.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-search mr-3"></i>
                        Lihat Daftar Alat
                    </a>
                </li>
                <li>
                    <a href="{{ route('peminjaman.ajukan') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition bg-blue-600">
                        <i class="fas fa-plus mr-3"></i>
                        Ajukan Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('peminjaman.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-list mr-3"></i>
                        Peminjaman Saya
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengembalian.index') }}"
                        class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
                        <i class="fas fa-history mr-3"></i>
                        Riwayat Pengembalian
                    </a>
                </li>
            @endif
        </ul>

        <!-- Logout Button -->
        <div class="mt-auto pt-4 border-t border-gray-600">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>
