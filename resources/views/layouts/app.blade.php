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

    <aside class="fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-sky-500 via-sky-600 to-blue-700 text-white shadow-2xl flex flex-col">

            {{-- Header --}}
            <div class="px-6 pt-8 pb-6 border-b border-white/15">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center text-3xl backdrop-blur">
                        🏥
                    </div>

                    <div>
                        <h1 class="text-xl font-bold leading-tight">
                            Klinik Azisah
                        </h1>

                        <p class="text-sky-100 text-sm">
                            Sistem Antrian Pasien
                        </p>
                    </div>

                </div>

            </div>

            {{-- Menu --}}
            <nav class="flex-1 px-4 py-6 space-y-2">

                <a href="/"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('/') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    🏠 Dashboard
                </a>

                <a href="/pasien"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('pasien*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    👤 Data Pasien
                </a>

                <a href="/antrian"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('antrian*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    🎫 Data Antrian
                </a>

                <a href="/jadwal-dokter"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('jadwal-dokter*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    👨‍⚕️ Jadwal Dokter
                </a>

                <a href="/pengaturan-klinik"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('pengaturan-klinik*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    ⚙️ Pengaturan Klinik
                </a>

                <a href="/riwayat"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('riwayat*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    📋 Riwayat Kunjungan
                </a>

                <a href="/laporan-bulanan"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('laporan-bulanan*') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    📈 Laporan Bulanan
                </a>

                <a href="/laporan"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('laporan') ? 'bg-white text-blue-700 shadow font-semibold' : 'hover:bg-white/15' }}">
                    📊 Laporan Harian
                </a>

            </nav>

            {{-- Footer --}}
            <div class="p-4 border-t border-white/15">

                <form action="/logout" method="POST">
                    @csrf

                    <button
                        class="w-full bg-red-500 hover:bg-red-600 py-3 rounded-xl font-semibold transition">
                        Logout
                    </button>

                </form>

            </div>

        </aside>

    <main class="flex-1 ml-72 p-8 min-h-screen">
        @yield('content')
    </main>

</div>

@stack('scripts')

</body>
</html>