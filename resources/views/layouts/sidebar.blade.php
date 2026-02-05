<aside>
    <div class="w-64 h-screen bg-gray-500 p-4 ">
        <h1 class="text-xl font-bold p-4">Dashboard</h1>

        <ul class="mb-4">
            <li class="mb-4">
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white">Home</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('alat.index') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white">Alat</a>
            </li>

            <li class="mb-4">
                <a href="{{ route('user.index') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white">Alat</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('peminjaman.index') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white">Alat</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('log_aktivitas.index') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white">Alat</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('pengembalian.index') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white">Alat</a>
            </li>
            @if(Auth::user()->role === 'admin')
                <li class="mb-2">
                    <a href="{{ route('kategori.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white transition">Kategori</a>
                </li>
                
            @endif

            <li class="mb-4">
                <a href=""
                    class="block px-4 py-2 rounded hover:bg-gray-700 hover:text-white">-</a>
            </li>
        </ul>
        <button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">Logout</button>
            </form>
        </button>
    </div>
</aside>
