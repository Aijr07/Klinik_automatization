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

    <aside class="fixed left-0 top-0 h-screen w-72 bg-gradient-to-b from-sky-500 to-blue-700 text-white p-6 shadow-2xl overflow-y-auto">

        <div class="mb-10">
            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-3xl mb-4">
                🏥
            </div>

            <h1 class="text-2xl font-bold">Dashboard Klinik Azisah</h1>
            <p class="text-sky-100 text-sm mt-1">Sistem Antrian Pasien</p>
        </div>

        <nav class="space-y-2">

            <a href="/" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('/') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Dashboard
            </a>

            <a href="/pasien" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('pasien*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Data Pasien
            </a>

            <a href="/antrian" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('antrian*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Data Antrian
            </a>

            <a href="/jadwal-dokter" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('jadwal-dokter*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Jadwal Dokter
            </a>

            <a href="/pengaturan-klinik" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('pengaturan-klinik*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Pengaturan Klinik
            </a>

            <a href="/riwayat" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('riwayat*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Riwayat Kunjungan
            </a>

            <a href="/laporan-bulanan" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('laporan-bulanan*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Laporan Bulanan
            </a>

            <a href="/laporan" class="block px-4 py-3 rounded-xl transition
                {{ request()->is('laporan') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-white/15' }}">
                Laporan Harian
            </a>

            <form action="/logout" method="POST" class="pt-4">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 rounded-xl bg-red-400/90 hover:bg-red-500 transition">
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    <main class="flex-1 ml-72 p-8">
        @yield('content')
    </main>

</div>

@stack('scripts')

</body>
</html>