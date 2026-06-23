<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white p-6">

        <h1 class="text-2xl font-bold mb-8">
            Dashboard Klinik
        </h1>

        <nav class="space-y-3">

            <a href="/"
               class="block bg-blue-900 px-4 py-2 rounded">
                Dashboard
            </a>

            <a href="/pasien"
               class="block px-4 py-2 rounded hover:bg-blue-800">
                Data Pasien
            </a>

            <a href="/antrian"
               class="block px-4 py-2 rounded hover:bg-blue-800">
                Data Antrian
            </a>

            <a href="/jadwal-dokter"
                class="block px-4 py-2 rounded hover:bg-blue-800">
                Jadwal Dokter
            </a>

            <a href="/pengaturan-klinik"
                class="block px-4 py-2 rounded hover:bg-blue-800">
                Pengaturan Klinik
            </a>

        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-8">

        <h2 class="text-3xl font-bold mb-6">
            Dashboard Klinik
        </h2>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Total Pasien</p>
                <h3 class="text-3xl font-bold">
                    {{ $totalPasien }}
                </h3>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Antrian Hari Ini</p>
                <h3 class="text-3xl font-bold">
                    {{ $antrianHariIni }}
                </h3>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Menunggu</p>
                <h3 class="text-3xl font-bold text-yellow-600">
                    {{ $menunggu }}
                </h3>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Dipanggil</p>
                <h3 class="text-3xl font-bold text-blue-600">
                    {{ $dipanggil }}
                </h3>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Selesai</p>
                <h3 class="text-3xl font-bold text-green-600">
                    {{ $selesai }}
                </h3>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Batal</p>
                <h3 class="text-3xl font-bold text-red-600">
                    {{ $batal }}
                </h3>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Pasien Baru Hari Ini</p>
                <h3 class="text-3xl font-bold text-indigo-600">
                    {{ $pasienBaruHariIni }}
                </h3>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Pasien Lama Hari Ini</p>
                <h3 class="text-3xl font-bold text-purple-600">
                    {{ $pasienLamaHariIni }}
                </h3>
            </div>
        </div>

        <div class="bg-white mt-8 p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-4">
                Grafik Kunjungan 7 Hari Terakhir
            </h3>

            <canvas id="kunjunganChart" height="100"></canvas>
        </div>

        <script>
            const ctx = document.getElementById('kunjunganChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labelTanggal),
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: @json($dataKunjungan),
                        borderWidth: 2,
                        tension: 0.3
                    }]
                }
            });
        </script>

        <!-- Tabel Antrian Terbaru -->
        <div class="bg-white mt-8 rounded shadow overflow-hidden">

            <div class="p-4 border-b flex justify-between items-center">

                <h3 class="text-xl font-bold">
                    Antrian Terbaru Hari Ini
                </h3>

                <a href="/antrian"
                   class="text-blue-600 hover:underline">
                    Lihat Semua
                </a>

            </div>

            <table class="w-full">

                <thead class="bg-gray-200">

                    <tr>
                        <th class="p-3 text-left">Nomor</th>
                        <th class="p-3 text-left">NRM</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Keluhan</th>
                        <th class="p-3 text-left">Status</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($antrianTerbaru as $item)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3 font-semibold">
                            {{ $item->nomor_antrian }}
                        </td>

                        <td class="p-3">
                            {{ $item->pasien->nrm ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $item->pasien->nama ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $item->keluhan }}
                        </td>

                        <td class="p-3">

                            @if($item->status == 'menunggu')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                    Menunggu
                                </span>

                            @elseif($item->status == 'dipanggil')
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                    Dipanggil
                                </span>

                            @elseif($item->status == 'selesai')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                    Selesai
                                </span>

                            @elseif($item->status == 'batal')
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded">
                                    Batal
                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5"
                            class="p-4 text-center text-gray-500">
                            Belum ada antrian hari ini.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>