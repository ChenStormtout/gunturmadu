<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 flex h-screen overflow-hidden font-sans">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
        <div class="p-6 text-xl font-bold border-b border-slate-800">Panel Desa</div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-slate-800">Dashboard</a>
            <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2 rounded hover:bg-slate-800">Kelola Berita</a>
            <!-- Tambah menu lain di sini nanti -->
        </nav>
        <div class="p-4 border-t border-slate-800">
            <!-- Form Logout bawaan Breeze -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-slate-800 rounded">Keluar</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <h2 class="font-semibold text-slate-800">@yield('header', 'Dashboard Admin')</h2>
            <div class="text-sm text-slate-500">Halo, {{ Auth::user()->name }}</div>
        </header>
        
        <div class="p-6">
            @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

</body>
</html>