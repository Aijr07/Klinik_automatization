@extends('layouts.app')

@section('title', 'Riwayat Kunjungan')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Riwayat Kunjungan
            </h1>
            <p class="text-slate-500 mt-1">
                Data pasien yang telah selesai melakukan kunjungan.
            </p>
        </div>

        <a href="/riwayat/export"
           class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-2xl shadow transition">
            Export CSV
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">
    <form method="GET" action="/riwayat" class="flex flex-wrap gap-3">

        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari nama atau NRM..."
            class="flex-1 border border-sky-100 bg-sky-50/60 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
        >

        <input
            type="date"
            name="tanggal"
            value="{{ $tanggal ?? '' }}"
            class="border border-sky-100 bg-sky-50/60 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
        >

        <button class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-2xl shadow transition">
            Filter
        </button>

        <a href="/riwayat"
           class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl transition">
            Reset
        </a>

    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Total Kunjungan</p>
        <h3 class="text-4xl font-bold text-blue-600 mt-2">
            {{ $totalRiwayat }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Pasien Baru</p>
        <h3 class="text-4xl font-bold text-indigo-500 mt-2">
            {{ $totalPasienBaru }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Pasien Lama</p>
        <h3 class="text-4xl font-bold text-purple-500 mt-2">
            {{ $totalPasienLama }}
        </h3>
    </div>

</div>

<div class="bg-white p-5 rounded-3xl shadow-sm border border-sky-100 mb-6">
    <p class="text-slate-600">
        Total riwayat kunjungan:
        <span class="font-bold text-blue-600">
            {{ $riwayat->count() }}
        </span>
    </p>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-sky-100 text-slate-700">
                <tr>
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Nomor Antrian</th>
                    <th class="p-4 text-left">NRM</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Keluhan</th>
                    <th class="p-4 text-left">Jenis Pasien</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($riwayat as $item)

                    <tr class="border-b border-sky-50 hover:bg-sky-50 transition">

                        <td class="p-4 text-slate-700">
                            {{ $item->tanggal }}
                        </td>

                        <td class="p-4 font-bold text-blue-600">
                            {{ $item->nomor_antrian }}
                        </td>

                        <td class="p-4 text-slate-700">
                            {{ $item->pasien->nrm ?? '-' }}
                        </td>

                        <td class="p-4">
                            @if($item->pasien)
                                <a href="/pasien/{{ $item->pasien->id }}"
                                   class="text-sky-600 hover:text-sky-700 hover:underline font-semibold">
                                    {{ $item->pasien->nama }}
                                </a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>

                        <td class="p-4 text-slate-700 max-w-md">

                            {{ $item->keluhan }}

                            @if($item->status == 'dirujuk')
                                <div class="mt-3 text-sm text-orange-700 bg-orange-50 border border-orange-100 p-3 rounded-xl">
                                    <p>
                                        <b>Tujuan:</b>
                                        {{ $item->tujuan_rujukan ?? '-' }}
                                    </p>

                                    <p class="mt-1">
                                        <b>Alasan:</b>
                                        {{ $item->alasan_rujukan ?? '-' }}
                                    </p>
                                </div>
                            @endif

                        </td>

                        <td class="p-4">

                            @if($item->jenis_pasien == 'baru')
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Pasien Baru
                                </span>

                            @elseif($item->jenis_pasien == 'lama')
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Pasien Lama
                                </span>

                            @else
                                <span class="text-slate-500">
                                    {{ $item->jenis_pasien }}
                                </span>
                            @endif

                        </td>

                        <td class="p-4">

                            @if($item->status == 'selesai')
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

                            @elseif($item->status == 'dipanggil')
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Dipanggil
                                </span>

                            @elseif($item->status == 'menunggu')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Menunggu
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
                        <td colspan="7" class="p-8 text-center text-slate-500">
                            Belum ada riwayat kunjungan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection