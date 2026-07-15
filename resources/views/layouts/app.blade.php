<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Klinik')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    @stack('scripts-head')
</head>

<body class="bg-sky-50">

<div class="flex min-h-screen">

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-sky-500 via-sky-600 to-blue-700 text-white shadow-2xl flex flex-col transition-all duration-300">

        {{-- Header --}}
        <div class="px-5 pt-6 pb-5 border-b border-white/15">

            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-3xl backdrop-blur">
                        🏥
                    </div>

                    <div class="sidebar-text">
                        <h1 class="text-xl font-bold leading-tight">
                            Klinik Azisah
                        </h1>

                        <p class="text-sky-100 text-sm">
                            Sistem Antrian Pasien
                        </p>
                    </div>
                </div>
            </div>

            <button
                id="toggleSidebar"
                type="button"
                class="w-full bg-white/20 hover:bg-white/30 rounded-xl py-2 font-semibold transition">
                ☰
            </button>

        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-4 py-5 space-y-2">

            <a href="/"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('/') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">🏠</span>
                <span class="sidebar-text">Dashboard</span>
            </a>

            <a href="/pasien"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('pasien*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">👤</span>
                <span class="sidebar-text">Data Pasien</span>
            </a>

            <a href="/antrian"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('antrian*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">🎫</span>
                <span class="sidebar-text">Data Antrian</span>
            </a>

            <a href="/jadwal-dokter"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('jadwal-dokter*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">👨‍⚕️</span>
                <span class="sidebar-text">Jadwal Dokter</span>
            </a>

            <a href="/pengaturan-klinik"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('pengaturan-klinik*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">⚙️</span>
                <span class="sidebar-text">Pengaturan Klinik</span>
            </a>

            <a href="/riwayat"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('riwayat*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">📋</span>
                <span class="sidebar-text">Riwayat Kunjungan</span>
            </a>

            <a href="/laporan-bulanan"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('laporan-bulanan*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">📈</span>
                <span class="sidebar-text">Laporan Bulanan</span>
            </a>

            <a href="/laporan"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('laporan') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                <span class="text-xl">📊</span>
                <span class="sidebar-text">Laporan Harian</span>
            </a>

        </nav>

        {{-- Footer --}}
        <div class="p-4 border-t border-white/15">

            <form action="/logout" method="POST">
                @csrf

                <button
                    class="w-full bg-red-500 hover:bg-red-600 py-3 rounded-xl font-semibold transition flex items-center justify-center gap-2">
                    <span>🚪</span>
                    <span class="sidebar-text">Logout</span>
                </button>

            </form>

        </div>

    </aside>

    <main id="mainContent" class="flex-1 ml-72 p-8 min-h-screen transition-all duration-300">
        @yield('content')
    </main>

</div>

@stack('scripts')

<script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');

    let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    function applySidebarState() {
        if (isCollapsed) {
            sidebar.classList.remove('w-72');
            sidebar.classList.add('w-20');

            mainContent.classList.remove('ml-72');
            mainContent.classList.add('ml-20');

            sidebarTexts.forEach(text => {
                text.classList.add('hidden');
            });

            toggleSidebar.classList.remove('w-full');
            toggleSidebar.classList.add('w-12', 'mx-auto');
        } else {
            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-72');

            mainContent.classList.remove('ml-20');
            mainContent.classList.add('ml-72');

            sidebarTexts.forEach(text => {
                text.classList.remove('hidden');
            });

            toggleSidebar.classList.remove('w-12', 'mx-auto');
            toggleSidebar.classList.add('w-full');
        }
    }

    applySidebarState();

    toggleSidebar.addEventListener('click', function () {
        isCollapsed = !isCollapsed;
        localStorage.setItem('sidebarCollapsed', isCollapsed);
        applySidebarState();
    });
</script>

</body>
</html>