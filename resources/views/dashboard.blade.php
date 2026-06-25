@extends('layouts.app')

@section('title', 'Dashboard Klinik')

@push('scripts-head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')

<div class="mb-8 bg-white/80 backdrop-blur rounded-3xl p-6 shadow-sm border border-sky-100">
    <h2 class="text-3xl font-bold text-slate-800">
        Dashboard Klinik
    </h2>
    <p class="text-slate-500 mt-1">
        Ringkasan data pasien, antrian, dan kunjungan klinik.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Total Pasien</p>
        <h3 class="text-4xl font-bold text-blue-600 mt-2">{{ $totalPasien }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Antrian Hari Ini</p>
        <h3 class="text-4xl font-bold text-sky-600 mt-2">{{ $antrianHariIni }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Menunggu</p>
        <h3 class="text-4xl font-bold text-yellow-500 mt-2">{{ $menunggu }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Dipanggil</p>
        <h3 class="text-4xl font-bold text-blue-500 mt-2">{{ $dipanggil }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Selesai</p>
        <h3 class="text-4xl font-bold text-green-500 mt-2">{{ $selesai }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Batal</p>
        <h3 class="text-4xl font-bold text-red-500 mt-2">{{ $batal }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Pasien Baru Hari Ini</p>
        <h3 class="text-4xl font-bold text-indigo-500 mt-2">{{ $pasienBaruHariIni }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100 hover:shadow-lg transition">
        <p class="text-slate-500">Pasien Lama Hari Ini</p>
        <h3 class="text-4xl font-bold text-purple-500 mt-2">{{ $pasienLamaHariIni }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-orange-100 hover:shadow-lg transition">
        <p class="text-slate-500">Pasien Dirujuk</p>
        <h3 class="text-4xl font-bold text-orange-600 mt-2">{{ $totalDirujuk }}</h3>
    </div>

</div>

<div class="bg-white mt-8 p-6 rounded-3xl shadow-sm border border-sky-100">
    <h3 class="text-xl font-bold text-slate-800 mb-4">
        Grafik Kunjungan 7 Hari Terakhir
    </h3>

    <canvas id="kunjunganChart" height="100"></canvas>
</div>

<div class="bg-white mt-8 rounded-3xl shadow-sm border border-sky-100 overflow-hidden">
    <div class="p-5 border-b border-sky-100 flex justify-between items-center">
        <h3 class="text-xl font-bold text-slate-800">
            Antrian Terbaru Hari Ini
        </h3>

        <a href="/antrian" class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-xl transition">
            Lihat Semua
        </a>
    </div>

    <table class="w-full">
        <thead class="bg-sky-100 text-slate-700">
            <tr>
                <th class="p-4 text-left">Nomor</th>
                <th class="p-4 text-left">NRM</th>
                <th class="p-4 text-left">Nama</th>
                <th class="p-4 text-left">Keluhan</th>
                <th class="p-4 text-left">Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($antrianTerbaru as $item)
            <tr class="border-b border-sky-50 hover:bg-sky-50 transition">
                <td class="p-4 font-semibold text-blue-600">
                    {{ $item->nomor_antrian }}
                </td>

                <td class="p-4">{{ $item->pasien->nrm ?? '-' }}</td>
                <td class="p-4">{{ $item->pasien->nama ?? '-' }}</td>
                <td class="p-4">{{ $item->keluhan }}</td>

                <td class="p-4">
                    @if($item->status == 'menunggu')
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Menunggu
                        </span>
                    @elseif($item->status == 'dipanggil')
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Dipanggil
                        </span>
                    @elseif($item->status == 'selesai')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Selesai
                        </span>
                    @elseif($item->status == 'dirujuk')
                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Dirujuk
                        </span>
                    @elseif($item->status == 'batal')
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Batal
                        </span>
                    @else
                        <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ ucfirst($item->status) }}
                        </span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-slate-500">
                    Belum ada antrian hari ini.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="bg-white mt-8 rounded-3xl shadow-sm border border-sky-100 overflow-hidden">
    <div class="p-5 border-b border-sky-100">
        <h3 class="text-xl font-bold text-slate-800">
            5 Pasien Paling Sering Berkunjung
        </h3>
    </div>

    <table class="w-full">
        <thead class="bg-sky-100 text-slate-700">
            <tr>
                <th class="p-4 text-left">NRM</th>
                <th class="p-4 text-left">Nama</th>
                <th class="p-4 text-left">Jumlah Kunjungan</th>
            </tr>
        </thead>

        <tbody>
        @foreach($pasienTerbanyak as $pasien)
            <tr class="border-b border-sky-50 hover:bg-sky-50 transition">
                <td class="p-4">{{ $pasien->nrm }}</td>
                <td class="p-4">{{ $pasien->nama }}</td>
                <td class="p-4 font-bold text-blue-600">
                    {{ $pasien->pendaftaran_count }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('kunjunganChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labelTanggal),
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: @json($dataKunjungan),
                borderWidth: 3,
                tension: 0.4,
                borderColor: '#38bdf8',
                backgroundColor: 'rgba(56, 189, 248, 0.15)',
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#0284c7'
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: '#334155'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush