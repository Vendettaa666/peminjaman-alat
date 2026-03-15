<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Peminjaman Sarpras</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(-24px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .anim-up   { animation: fadeUp 0.6s cubic-bezier(.22,.68,0,1.15) forwards; }
        .anim-left { animation: slideRight 0.65s cubic-bezier(.22,.68,0,1.15) forwards; }
        .d1 { animation-delay: 0.08s; opacity: 0; }
        .d2 { animation-delay: 0.16s; opacity: 0; }
        .d3 { animation-delay: 0.22s; opacity: 0; }
        .d4 { animation-delay: 0.28s; opacity: 0; }
        .d5 { animation-delay: 0.34s; opacity: 0; }
        .d6 { animation-delay: 0.40s; opacity: 0; }
        .d7 { animation-delay: 0.46s; opacity: 0; }
        .d8 { animation-delay: 0.52s; opacity: 0; }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-[#13132a] p-4">

    {{-- ═══════════════════════════════════════════════
         CARD WRAPPER — wider to accommodate more fields
    ═══════════════════════════════════════════════ --}}
    <div class="flex w-full max-w-4xl min-h-[600px] rounded-3xl overflow-hidden
                shadow-[0_32px_80px_rgba(0,0,0,0.55)]">

        {{-- ─── LEFT PANEL ─────────────────────────────── --}}
        <div class="relative hidden md:flex flex-1 flex-col justify-between overflow-hidden
                    bg-gradient-to-br from-[#1e1b4b] via-[#312e81] to-[#6d28d9] p-9">

            {{-- Ambient glow blobs --}}
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute top-[-60px] left-[-60px] w-72 h-72 rounded-full
                            bg-violet-600/25 blur-3xl"></div>
                <div class="absolute bottom-[-40px] right-[-40px] w-64 h-64 rounded-full
                            bg-indigo-500/20 blur-3xl"></div>
                <div class="absolute top-[40%] left-[30%] w-48 h-48 rounded-full
                            bg-purple-700/15 blur-2xl"></div>
            </div>

            {{-- Dot-grid texture --}}
            <div class="pointer-events-none absolute inset-0"
                 style="background-image:radial-gradient(circle,rgba(255,255,255,0.06) 1px,transparent 1px);background-size:28px 28px;"></div>

            {{-- Brand top --}}
            <div class="relative z-10 flex items-center justify-between anim-left d1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/15 border border-white/25
                                flex items-center justify-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-lg tracking-widest">SARPRAS</span>
                </div>
                <a href="#"
                   class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20
                          border border-white/20 rounded-full px-4 py-1.5
                          text-xs font-medium text-white/80 transition-colors duration-200">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5">
                        <path d="M19 12H5M12 5l-7 7 7 7"/>
                    </svg>
                    Kembali ke website
                </a>
            </div>

            {{-- Mountain SVG --}}
            <svg class="absolute bottom-0 left-0 right-0 w-full z-[1]"
                 viewBox="0 0 500 300" xmlns="http://www.w3.org/2000/svg"
                 preserveAspectRatio="xMidYMax meet">
                <defs>
                    <linearGradient id="rg-m3" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#312e81"/>
                        <stop offset="100%" stop-color="#1e1b4b"/>
                    </linearGradient>
                    <linearGradient id="rg-m2" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#4c1d95"/>
                        <stop offset="100%" stop-color="#2e1065"/>
                    </linearGradient>
                    <linearGradient id="rg-m1" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#5b21b6"/>
                        <stop offset="100%" stop-color="#3b0764"/>
                    </linearGradient>
                    <linearGradient id="rg-sky" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#1e1b4b" stop-opacity="0"/>
                        <stop offset="100%" stop-color="#1e1b4b" stop-opacity="0.75"/>
                    </linearGradient>
                </defs>
                <polygon points="0,200 70,110 150,165 230,85 320,150 420,65 500,130 500,300 0,300"
                         fill="url(#rg-m3)" opacity="0.7"/>
                <polygon points="0,235 90,150 180,195 265,105 355,165 460,100 500,145 500,300 0,300"
                         fill="url(#rg-m2)" opacity="0.88"/>
                <polygon points="-10,300 60,185 140,225 220,145 310,200 400,125 500,178 500,300"
                         fill="url(#rg-m1)"/>
                <rect x="0" y="0" width="500" height="300" fill="url(#rg-sky)"/>
            </svg>

            {{-- Stars --}}
            <div class="pointer-events-none absolute inset-0 z-[2]" aria-hidden="true">
                @foreach([['12%','15%'],['30%','8%'],['55%','20%'],['72%','6%'],['85%','18%'],
                          ['20%','35%'],['65%','30%'],['40%','12%'],['90%','40%']] as $s)
                <div class="absolute w-0.5 h-0.5 rounded-full bg-white/60"
                     style="left:{{ $s[0] }};top:{{ $s[1] }}"></div>
                @endforeach
            </div>

            {{-- Features list --}}
            <div class="relative z-10 space-y-3 anim-left d2">
                @foreach([
                    ['📋', 'Ajukan peminjaman ruang & peralatan'],
                    ['🔔', 'Notifikasi status peminjaman real-time'],
                    ['📊', 'Riwayat & laporan penggunaan fasilitas'],
                ] as $f)
                <div class="flex items-center gap-3 bg-white/[0.07] border border-white/10
                            rounded-xl px-4 py-3 backdrop-blur-sm">
                    <span class="text-base">{{ $f[0] }}</span>
                    <span class="text-sm text-white/75 font-medium">{{ $f[1] }}</span>
                </div>
                @endforeach
            </div>

            {{-- Tagline --}}
            <div class="relative z-10 anim-left d3">
                <p class="text-3xl font-extrabold text-white leading-snug drop-shadow-lg">
                    Bergabung &<br>
                    <span class="text-violet-300">Mulai Kelola</span><br>
                    Fasilitas Sekolah
                </p>
                <p class="mt-2 text-sm text-white/50 font-medium">
                    Daftar gratis, tidak perlu kartu kredit
                </p>
            </div>
        </div>

        {{-- ─── RIGHT PANEL ─────────────────────────────── --}}
        <div class="flex flex-col justify-center bg-[#1c1d35] px-9 py-10 w-full md:w-[420px]">

            {{-- Header --}}
            <div class="mb-6 anim-up d2">
                <h1 class="text-[26px] font-extrabold text-slate-100 leading-tight">Buat Akun Baru</h1>
                <p class="mt-1 text-sm text-slate-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                       class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </div>

            {{-- Error box --}}
            @if ($errors->any())
            <div class="mb-5 bg-red-500/10 border border-red-500/25 rounded-xl px-4 py-3 anim-up d2">
                <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest mb-1">Terjadi Kesalahan</p>
                @foreach ($errors->all() as $error)
                    <p class="text-red-300 text-sm">• {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                {{-- First & Last name row --}}
                <div class="grid grid-cols-2 gap-3 anim-up d3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Nama Depan
                        </label>
                        <input
                            type="text"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            placeholder="Budi"
                            required
                            class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                   text-sm text-slate-200 placeholder-slate-600 font-medium
                                   focus:outline-none focus:border-indigo-500
                                   focus:ring-[3px] focus:ring-indigo-500/20 transition-all duration-200"
                        >
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Nama Belakang
                        </label>
                        <input
                            type="text"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            placeholder="Santoso"
                            class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                   text-sm text-slate-200 placeholder-slate-600 font-medium
                                   focus:outline-none focus:border-indigo-500
                                   focus:ring-[3px] focus:ring-indigo-500/20 transition-all duration-200"
                        >
                    </div>
                </div>

                {{-- Email --}}
                <div class="anim-up d4">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@sekolah.ac.id"
                        required
                        class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                               text-sm text-slate-200 placeholder-slate-600 font-medium
                               focus:outline-none focus:border-indigo-500
                               focus:ring-[3px] focus:ring-indigo-500/20 transition-all duration-200"
                    >
                </div>

                {{-- Role --}}
                <div class="anim-up d5">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                        Peran
                    </label>
                    <select
                        name="role"
                        required
                        class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                               text-sm text-slate-400 font-medium appearance-none
                               focus:outline-none focus:border-indigo-500
                               focus:ring-[3px] focus:ring-indigo-500/20 transition-all duration-200
                               cursor-pointer"
                    >
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih peran Anda</option>
                        <option value="guru"     {{ old('role') == 'guru'     ? 'selected' : '' }}>Guru / Pengajar</option>
                        <option value="siswa"    {{ old('role') == 'siswa'    ? 'selected' : '' }}>Siswa</option>
                        <option value="staff"    {{ old('role') == 'staff'    ? 'selected' : '' }}>Staff / Karyawan</option>
                        <option value="admin"    {{ old('role') == 'admin'    ? 'selected' : '' }}>Admin Sarpras</option>
                    </select>
                </div>

                {{-- Password --}}
                <div class="anim-up d6">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="pwd-reg"
                            placeholder="Min. 8 karakter"
                            required
                            class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4 pr-11
                                   text-sm text-slate-200 placeholder-slate-600
                                   focus:outline-none focus:border-indigo-500
                                   focus:ring-[3px] focus:ring-indigo-500/20 transition-all duration-200"
                        >
                        <button type="button"
                                onclick="togglePwd('pwd-reg',this)"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2
                                       text-slate-500 hover:text-slate-300 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="anim-up d7">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="pwd-confirm"
                            placeholder="Ulangi password"
                            required
                            class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4 pr-11
                                   text-sm text-slate-200 placeholder-slate-600
                                   focus:outline-none focus:border-indigo-500
                                   focus:ring-[3px] focus:ring-indigo-500/20 transition-all duration-200"
                        >
                        <button type="button"
                                onclick="togglePwd('pwd-confirm',this)"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2
                                       text-slate-500 hover:text-slate-300 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3 anim-up d8">
                    <input
                        type="checkbox"
                        name="terms"
                        id="terms"
                        required
                        class="mt-0.5 w-4 h-4 flex-shrink-0 rounded border-slate-600
                               bg-[#252740] accent-indigo-500 cursor-pointer"
                    >
                    <label for="terms" class="text-xs text-slate-400 cursor-pointer select-none leading-relaxed">
                        Saya menyetujui
                        <a href="#" class="text-indigo-400 hover:text-indigo-300 font-semibold transition-colors">
                            Syarat & Ketentuan
                        </a>
                        serta
                        <a href="#" class="text-indigo-400 hover:text-indigo-300 font-semibold transition-colors">
                            Kebijakan Privasi
                        </a>
                        yang berlaku
                    </label>
                </div>

                {{-- Submit --}}
                <div class="pt-1 anim-up d8">
                    <button type="submit"
                            class="w-full h-11 rounded-xl font-bold text-sm text-white tracking-wide
                                   bg-gradient-to-r from-indigo-500 to-violet-600
                                   shadow-[0_4px_20px_rgba(99,102,241,0.4)]
                                   hover:shadow-[0_8px_28px_rgba(99,102,241,0.55)]
                                   hover:-translate-y-px active:translate-y-0
                                   transition-all duration-200">
                        Buat Akun
                    </button>
                </div>
            </form>

            {{-- Divider --}}
            <div class="relative flex items-center gap-3 my-5 anim-up d8">
                <div class="flex-1 h-px bg-[#2d3154]"></div>
                <span class="text-xs text-slate-600 font-medium whitespace-nowrap">atau daftar dengan</span>
                <div class="flex-1 h-px bg-[#2d3154]"></div>
            </div>

            {{-- Social stub (UI only) --}}
            <div class="grid grid-cols-2 gap-3 anim-up d8">
                <button type="button"
                        class="flex items-center justify-center gap-2.5 h-11 rounded-xl
                               bg-[#252740] border border-[#363a5e] hover:border-indigo-500/40
                               text-sm font-semibold text-slate-300 hover:text-white
                               transition-all duration-200">
                    <svg width="17" height="17" viewBox="0 0 24 24">
                        <path fill="#EA4335" d="M5.27 9.76A7.08 7.08 0 0 1 19.07 12c0 .68-.06 1.34-.17 1.97H12v-3.73h7.6A7.1 7.1 0 0 1 5.27 9.76z"/>
                        <path fill="#FBBC05" d="M3.17 14.34A7.08 7.08 0 0 1 12 4.92a6.99 6.99 0 0 1 4.56 1.69L14 9.17A3.83 3.83 0 0 0 8.58 11.1l-5.41 3.24z" opacity=".9"/>
                        <path fill="#34A853" d="M12 19.08a7.05 7.05 0 0 1-5.81-3.06L11.6 12.8a3.82 3.82 0 0 0 5.57-1.97l5.52 3.3A7.07 7.07 0 0 1 12 19.08z"/>
                        <path fill="#4285F4" d="M3.17 14.34l5.41-3.24a3.83 3.83 0 0 1 .42-1.24L3.59 6.62A7.07 7.07 0 0 0 3.17 14.34z"/>
                    </svg>
                    Google
                </button>
                <button type="button"
                        class="flex items-center justify-center gap-2.5 h-11 rounded-xl
                               bg-[#252740] border border-[#363a5e] hover:border-indigo-500/40
                               text-sm font-semibold text-slate-300 hover:text-white
                               transition-all duration-200">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                    </svg>
                    Apple
                </button>
            </div>

        </div>
    </div>

    <script>
        function togglePwd(id, btn) {
            const inp = document.getElementById(id);
            const isText = inp.type === 'text';
            inp.type = isText ? 'password' : 'text';
            btn.querySelector('svg').style.opacity = isText ? '1' : '0.45';
        }
    </script>
</body>
</html>
