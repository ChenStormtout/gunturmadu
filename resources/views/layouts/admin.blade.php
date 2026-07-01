<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 flex h-screen overflow-hidden font-sans">

    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
        <div class="p-6 text-xl font-bold border-b border-slate-800">Panel Desa</div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'bg-slate-800 text-emerald-400' : '' }}">Dashboard</a>
            
            <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('admin.berita.*') ? 'bg-slate-800 text-emerald-400' : '' }}">Kelola Berita</a>
            
            <a href="{{ route('admin.galeri.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('admin.galeri.*') ? 'bg-slate-800 text-emerald-400' : '' }}">Kelola Galeri</a>
            
            <a href="{{ route('admin.aparatur.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('admin.aparatur.*') ? 'bg-slate-800 text-emerald-400' : '' }}">Kelola Aparatur</a>
            
            <a href="{{ route('admin.profil.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('admin.profil.*') ? 'bg-slate-800 text-emerald-400' : '' }}">Profil Desa</a>

            @php
                $laporanBaru = \App\Models\Laporan::where('is_verified', true)->where('status', 'menunggu')->count();
            @endphp
            <a href="{{ route('admin.laporan.index') }}" class="flex justify-between items-center px-4 py-2 rounded hover:bg-slate-800 {{ request()->routeIs('admin.laporan.*') ? 'bg-slate-800 text-emerald-400' : '' }}">
                Laporan Warga
                @if($laporanBaru > 0)
                    <span class="bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full animate-pulse">{{ $laporanBaru }}</span>
                @endif
            </a>
        </nav>
        
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-slate-800 rounded transition">Keluar</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <h2 class="font-semibold text-slate-800">@yield('header', 'Dashboard Admin')</h2>
            <div class="text-sm text-slate-500 font-medium">Halo, {{ Auth::user()->name }}</div>
        </header>
        
        <div class="p-6">
            @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg font-semibold text-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

</body>
</html>