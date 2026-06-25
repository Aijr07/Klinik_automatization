@extends('layouts.app')

@section('title', 'Laporan Harian')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Laporan Harian
            </h1>
            <p class="text-slate-500 mt-1">
                Ringkasan kunjungan pasien berdasarkan tanggal.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="/laporan/export?tanggal={{ $tanggal }}"
               class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-2xl shadow transition">
                Export CSV
            </a>

        </div>
    </div>
</div>

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">
    <form method="GET" action="/laporan" class="flex gap-3">

        <input
            type="date"
            name="tanggal"
            value="{{ $tanggal }}"
            class="border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400">

        <button class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-2xl shadow transition">
            Filter
        </button>

    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Total</p>
        <h3 class="text-4xl font-bold text-blue-600 mt-2">{{ $total }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Pasien Baru</p>
        <h3 class="text-4xl font-bold text-indigo-500 mt-2">{{ $pasienBaru }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Pasien Lama</p>
        <h3 class="text-4xl font-bold text-purple-500 mt-2">{{ $pasienLama }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Menunggu</p>
        <h3 class="text-4xl font-bold text-yellow-500 mt-2">{{ $menunggu }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Dipanggil</p>
        <h3 class="text-4xl font-bold text-sky-500 mt-2">{{ $dipanggil }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Selesai</p>
        <h3 class="text-4xl font-bold text-green-500 mt-2">{{ $selesai }}</h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Batal</p>
        <h3 class="text-4xl font-bold text-red-500 mt-2">{{ $batal }}</h3>
    </div>

</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">

    <table class="w-full">
        <thead class="bg-sky-100 text-slate-700">
            <tr>
                <th class="p-4 text-left">Nomor</th>
                <th class="p-4 text-left">NRM</th>
                <th class="p-4 text-left">Nama</th>
                <th class="p-4 text-left">Keluhan</th>
                <th class="p-4 text-left">Jenis</th>
                <th class="p-4 text-left">Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($data as $item)

            <tr class="border-b border-sky-50 hover:bg-sky-50 transition">

                <td class="p-4 font-bold text-blue-600">
                    {{ $item->nomor_antrian }}
                </td>

                <td class="p-4">
                    {{ $item->pasien->nrm ?? '-' }}
                </td>

                <td class="p-4">
                    {{ $item->pasien->nama ?? '-' }}
                </td>

                <td class="p-4">
                    {{ $item->keluhan }}
                </td>

                <td class="p-4">
                    {{ ucfirst($item->jenis_pasien) }}
                </td>

                <td class="p-4">
                    {{ ucfirst($item->status) }}
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" class="p-8 text-center text-slate-500">
                    Tidak ada data laporan pada tanggal ini.
                </td>
            </tr>

        @endforelse
        </tbody>

    </table>

</div>

@endsection