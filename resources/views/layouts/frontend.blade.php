<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#047857">

    <title>@yield('title', 'Beranda') · Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}</title>
    <meta name="description" content="@yield('meta_description', 'Portal resmi Desa ' . ($profil['nama_desa'] ?? 'Gunturmadu') . ' — informasi, berita, statistik, dan profil desa.')">

    {{-- Open Graph, biar preview-nya bagus kalau dibagikan di WhatsApp / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Desa ' . ($profil['nama_desa'] ?? 'Gunturmadu'))">
    <meta property="og:description" content="@yield('meta_description', 'Portal resmi Desa ' . ($profil['nama_desa'] ?? 'Gunturmadu'))">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- Ganti dengan favicon asli desa kalau sudah ada di public/favicon.ico --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        html { scroll-behavior: smooth; }
        /* offset scroll biar section gak ketutup navbar fixed */
        [id] { scroll-margin-top: 6rem; }
    </style>
</head>
<body class="font-[Plus_Jakarta_Sans] bg-slate-50 text-slate-800 antialiased">

    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl bg-white/70 border-b border-white/20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-20">

                <a href="/" class="flex items-center gap-3 shrink-0">
                    @if(!empty($profil['logo']))
                        <img src="{{ asset('storage/'.$profil['logo']) }}" alt="Logo Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}" class="w-11 h-11 rounded-2xl object-cover shadow-lg">
                    @else
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold shadow-lg">
                            {{ strtoupper(substr($profil['nama_desa'] ?? 'Desa', 0, 1)) }}
                        </div>
                    @endif

                    <div class="leading-tight">
                        <h1 class="font-bold text-slate-900">
                            Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}
                        </h1>
                        <p class="text-xs text-slate-500">
                            Profil &amp; Informasi Desa
                        </p>
                    </div>
                </a>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="/" class="relative text-sm font-medium transition {{ request()->is('/') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}">
                        Beranda
                        @if(request()->is('/'))
                            <span class="absolute -bottom-2 left-0 right-0 h-0.5 rounded-full bg-emerald-500"></span>
                        @endif
                    </a>
                    <a href="/berita" class="relative text-sm font-medium transition {{ request()->is('berita*') ? 'text-emerald-600' : 'text-slate-600 hover:text-emerald-600' }}">
                        Berita
                        @if(request()->is('berita*'))
                            <span class="absolute -bottom-2 left-0 right-0 h-0.5 rounded-full bg-emerald-500"></span>
                        @endif
                    </a>
                    <a href="/#tentang" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Profil</a>
                    <a href="/#galeri" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Galeri</a>
                    <a href="/#kontak" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Kontak</a>
                </div>

                {{-- Tombol hamburger, mobile --}}
                <button id="menu-toggle" type="button" class="md:hidden relative w-10 h-10 flex items-center justify-center rounded-xl hover:bg-slate-100 transition" aria-label="Buka menu" aria-expanded="false">
                    <svg id="icon-open" class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="icon-close" class="w-6 h-6 text-slate-700 hidden" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" viewBox="0 0 24 24">
                        <path d="M6 6l12 12M18 6L6 18"/>
                    </svg>
                </button>

            </div>
        </div>

        {{-- Panel menu mobile --}}
        <div id="mobile-menu" class="md:hidden hidden border-t border-slate-100 bg-white/95 backdrop-blur-xl">
            <div class="px-6 py-5 flex flex-col gap-1">
                <a href="/" class="px-3 py-3 rounded-xl text-sm font-medium {{ request()->is('/') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">Beranda</a>
                <a href="/berita" class="px-3 py-3 rounded-xl text-sm font-medium {{ request()->is('berita*') ? 'bg-emerald-50 text-emerald-600' : 'text-slate-600 hover:bg-slate-50' }}">Berita</a>
                <a href="/#tentang" class="px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50">Profil</a>
                <a href="/#galeri" class="px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50">Galeri</a>
                <a href="/#kontak" class="px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50">Kontak</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer id="kontak" class="bg-slate-950 text-white">

        <div class="max-w-7xl mx-auto px-6 py-20">

            <div class="grid md:grid-cols-3 gap-12">

                <div>
                    <h3 class="font-bold text-2xl mb-4">
                        Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}
                    </h3>

                    <p class="text-slate-400 leading-relaxed">
                        Portal informasi desa untuk mendukung
                        transparansi, pelayanan, dan pengembangan potensi desa.
                    </p>

                    <div class="flex items-center gap-3 mt-6">
                        <a href="{{ $profil['instagram'] ?? '#' }}" target="_blank" aria-label="Instagram" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-emerald-500/20 hover:border-emerald-500/30 transition">
                            <svg class="w-4.5 h-4.5 text-white/80" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="0.6" fill="currentColor"/></svg>
                        </a>
                        <a href="{{ $profil['facebook'] ?? '#' }}" target="_blank" aria-label="Facebook" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-emerald-500/20 hover:border-emerald-500/30 transition">
                            <svg class="w-4.5 h-4.5 text-white/80" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M14 9h2.5V6.5H14C12 6.5 11 7.6 11 9.5V11H9v2.5h2V18h2.5v-4.5H16l.5-2.5H13.5v-1c0-.6.3-1 1-1z"/></svg>
                        </a>
                        <a href="https://wa.me/{{ $profil['telepon_desa'] ?? '' }}" target="_blank" aria-label="WhatsApp" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-emerald-500/20 hover:border-emerald-500/30 transition">
                            <svg class="w-4.5 h-4.5 text-white/80" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M3 20l1.4-4.1A8 8 0 1112 20a8 8 0 01-5-1.7L3 20z"/><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">
                        Navigasi
                    </h4>

                    <ul class="space-y-3 text-slate-400 text-sm">
                        <li><a href="/" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="/berita" class="hover:text-emerald-400 transition">Berita</a></li>
                        <li><a href="/#tentang" class="hover:text-emerald-400 transition">Profil Desa</a></li>
                        <li><a href="/#galeri" class="hover:text-emerald-400 transition">Galeri</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">
                        Kontak
                    </h4>

                    <div class="space-y-3 text-slate-400 text-sm">
                        <p class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7-6.1-7-11a7 7 0 1114 0c0 4.9-7 11-7 11z"/><circle cx="12" cy="10" r="2.3"/></svg>
                            <span>Kantor Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}, Kec. {{ $profil['kecamatan'] ?? '-' }}, Kab. {{ $profil['kabupaten'] ?? '-' }}, {{ $profil['provinsi'] ?? '-' }}</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h4l2 5-2.5 1.5a11 11 0 005 5L13 14l5 2v4a2 2 0 01-2 2C8.6 22 2 15.4 2 7a2 2 0 012-2z"/></svg>
                            <span>{{ $profil['telepon_desa'] ?? '(0xx) xxx-xxxx' }}</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6"/></svg>
                            <span>{{ $profil['email_desa'] ?? 'desa@gunturmadu.go.id' }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-slate-500">
                <p>© {{ date('Y') }} Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}. Hak cipta dilindungi.</p>
                <p>Dikelola oleh Pemerintah Desa {{ $profil['nama_desa'] ?? 'Gunturmadu' }}</p>
            </div>

        </div>

    </footer>

    {{-- Tombol WhatsApp melayang --}}
    @if(!empty($profil['telepon_desa']))
    <a href="https://wa.me/{{ $profil['telepon_desa'] }}" target="_blank" aria-label="Hubungi kami via WhatsApp"
       class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 shadow-xl shadow-emerald-500/30 flex items-center justify-center text-white transition hover:scale-105">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 20l1.4-4.1A8 8 0 1112 20a8 8 0 01-5-1.7L3 20z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9.5c0 3 2.5 5.5 5.5 5.5"/>
        </svg>
    </a>
    @endif

    <script>
        // Efek bayangan navbar saat halaman di-scroll
        const nav = document.getElementById('main-nav');
        const onScroll = () => {
            if (window.scrollY > 12) {
                nav.classList.add('shadow-[0_8px_30px_rgba(15,23,42,0.06)]');
                nav.classList.remove('bg-white/70');
                nav.classList.add('bg-white/85');
            } else {
                nav.classList.remove('shadow-[0_8px_30px_rgba(15,23,42,0.06)]');
                nav.classList.remove('bg-white/85');
                nav.classList.add('bg-white/70');
            }
        };
        window.addEventListener('scroll', onScroll);
        onScroll();

        // Toggle menu mobile
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');

        function closeMenu() {
            mobileMenu.classList.add('hidden');
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
            menuToggle.setAttribute('aria-expanded', 'false');
        }

        menuToggle.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');
            if (isOpen) {
                closeMenu();
            } else {
                mobileMenu.classList.remove('hidden');
                iconOpen.classList.add('hidden');
                iconClose.classList.remove('hidden');
                menuToggle.setAttribute('aria-expanded', 'true');
            }
        });

        // Tutup menu otomatis kalau salah satu link diklik
        mobileMenu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
    </script>

    @yield('scripts')

</body>
</html>