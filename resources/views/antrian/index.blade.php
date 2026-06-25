@extends('layouts.app')

@section('title', 'Data Antrian')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Data Antrian Pasien
            </h1>
            <p class="text-slate-500 mt-1">
                Kelola status antrian pasien klinik.
            </p>
        </div>

        <a href="/"
           class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-5 py-3 rounded-2xl shadow transition">
            Dashboard
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl mb-6 shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">
    <p class="text-sm font-semibold text-slate-600 mb-3">Filter Status</p>

    <div class="flex flex-wrap gap-2">
        <a href="/antrian" class="px-4 py-2 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
            Semua
        </a>

        <a href="/antrian?status=menunggu" class="px-4 py-2 rounded-2xl bg-yellow-100 hover:bg-yellow-200 text-yellow-700 font-semibold transition">
            Menunggu
        </a>

        <a href="/antrian?status=dipanggil" class="px-4 py-2 rounded-2xl bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold transition">
            Dipanggil
        </a>

        <a href="/antrian?status=selesai" class="px-4 py-2 rounded-2xl bg-green-100 hover:bg-green-200 text-green-700 font-semibold transition">
            Selesai
        </a>

        <a href="/antrian?status=dirujuk" class="px-4 py-2 rounded-2xl bg-orange-100 hover:bg-orange-200 text-orange-700 font-semibold transition">
            Dirujuk
        </a>

        <a href="/antrian?status=batal" class="px-4 py-2 rounded-2xl bg-red-100 hover:bg-red-200 text-red-700 font-semibold transition">
            Batal
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">
    <form method="GET" action="/antrian" class="flex gap-3">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari nama, NRM, nomor antrian, keluhan..."
            class="w-full border border-sky-100 bg-sky-50/60 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
        >

        @if($status)
            <input type="hidden" name="status" value="{{ $status }}">
        @endif

        <button class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-2xl shadow transition">
            Cari
        </button>
    </form>
</div>

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">
    <p class="text-sm font-semibold text-slate-600 mb-3">Filter Jenis Pasien</p>

    <div class="flex flex-wrap gap-2">
        <a href="/antrian" class="px-4 py-2 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
            Semua Jenis
        </a>

        <a href="/antrian?jenis=baru" class="px-4 py-2 rounded-2xl bg-indigo-100 hover:bg-indigo-200 text-indigo-700 font-semibold transition">
            Pasien Baru
        </a>

        <a href="/antrian?jenis=lama" class="px-4 py-2 rounded-2xl bg-purple-100 hover:bg-purple-200 text-purple-700 font-semibold transition">
            Pasien Lama
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-sky-100 text-slate-700">
                <tr>
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Nomor Antrian</th>
                    <th class="p-4 text-left">NRM</th>
                    <th class="p-4 text-left">Nama Pasien</th>
                    <th class="p-4 text-left">Jenis Pasien</th>
                    <th class="p-4 text-left">Keluhan</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($antrian as $item)
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
                            <a href="/pasien/{{ $item->pasien->id }}" class="text-sky-600 hover:text-sky-700 font-semibold hover:underline">
                                {{ $item->pasien->nama }}
                            </a>
                        @else
                            <span class="text-slate-400">-</span>
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
                            <span class="text-slate-400">-</span>
                        @endif
                    </td>

                    <td class="p-4 text-slate-700 max-w-xs">
                        {{ $item->keluhan }}
                    </td>

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
                        @endif
                    </td>

                    <td class="p-4">
                        <div class="flex flex-wrap gap-2 justify-center">
                            <form action="/antrian/{{ $item->id }}/status" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="dipanggil">

                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                                    Panggil
                                </button>
                            </form>

                            <form action="/antrian/{{ $item->id }}/status" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="selesai">

                                <button
                                    type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                                    Selesai
                                </button>
                            </form>

                            <a href="/antrian/{{ $item->id }}/rujuk"
                               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                                Rujuk
                            </a>

                            <form action="/antrian/{{ $item->id }}/status" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="batal">

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition"
                                    onclick="return confirm('Yakin ingin membatalkan antrian ini?')">
                                    Batal
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-8 text-slate-500">
                        Belum ada data antrian
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection