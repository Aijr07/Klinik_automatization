@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Detail Pasien
            </h1>
            <p class="text-slate-500 mt-1">
                Informasi lengkap pasien dan riwayat kunjungannya.
            </p>
        </div>

        <div class="flex gap-3">
            <a href="/pasien/{{ $pasien->id }}/edit"
               class="bg-yellow-400 hover:bg-yellow-500 text-white px-5 py-3 rounded-2xl shadow transition">
                Edit Pasien
            </a>

            <a href="/pasien"
               class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-5 py-3 rounded-2xl shadow transition">
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-6 mb-6">
    <h2 class="text-xl font-bold text-slate-800 mb-5 border-b border-sky-100 pb-3">
        Data Pasien
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="bg-sky-50 rounded-2xl p-4">
            <span class="text-sm font-semibold text-slate-500">NRM</span>
            <p class="text-lg font-bold text-blue-600">{{ $pasien->nrm }}</p>
        </div>

        <div class="bg-sky-50 rounded-2xl p-4">
            <span class="text-sm font-semibold text-slate-500">Nama</span>
            <p class="text-lg font-bold text-slate-800">{{ $pasien->nama }}</p>
        </div>

        <div class="bg-sky-50 rounded-2xl p-4">
            <span class="text-sm font-semibold text-slate-500">Umur</span>
            <p class="text-lg text-slate-800">{{ $pasien->umur }}</p>
        </div>

        <div class="bg-sky-50 rounded-2xl p-4">
            <span class="text-sm font-semibold text-slate-500">Telepon</span>
            <p class="text-lg text-slate-800">{{ $pasien->telepon }}</p>
        </div>

        <div class="bg-sky-50 rounded-2xl p-4">
            <span class="text-sm font-semibold text-slate-500">Nomor WhatsApp</span>
            <p class="text-lg text-slate-800">{{ $pasien->nomor_wa }}</p>
        </div>

        <div class="bg-sky-50 rounded-2xl p-4">
            <span class="text-sm font-semibold text-slate-500">Alamat</span>
            <p class="text-lg text-slate-800">{{ $pasien->alamat }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">
    <div class="p-6 border-b border-sky-100">
        <h2 class="text-xl font-bold text-slate-800">
            Riwayat Keluhan Pasien
        </h2>

        <p class="text-slate-500 mt-1">
            Total Kunjungan:
            <strong class="text-blue-600">{{ $pasien->pendaftaran->count() }}</strong>
        </p>
    </div>

    <div class="p-6">
        @forelse($pasien->pendaftaran->sortByDesc('tanggal') as $item)

            <div class="bg-sky-50 border border-sky-100 rounded-3xl p-5 mb-5">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg text-slate-800">
                        {{ $item->tanggal }}
                    </h3>

                    <span class="bg-white text-blue-600 px-4 py-2 rounded-full text-sm font-bold shadow-sm">
                        {{ $item->nomor_antrian }}
                    </span>
                </div>

                <div class="space-y-2 text-slate-700">
                    <p>
                        <span class="font-semibold text-slate-800">Keluhan:</span>
                        {{ $item->keluhan }}
                    </p>

                    <p>
                        <span class="font-semibold text-slate-800">Jenis Pasien:</span>
                        {{ ucfirst($item->jenis_pasien) }}
                    </p>

                    <p>
                        <span class="font-semibold text-slate-800">Status:</span>

                        @if($item->status == 'selesai')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Selesai
                            </span>
                        @elseif($item->status == 'dipanggil')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Dipanggil
                            </span>
                        @elseif($item->status == 'menunggu')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Menunggu
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
                            {{ $item->status }}
                        @endif
                    </p>

                    @if($item->status == 'dirujuk')
                        <div class="mt-4 bg-orange-50 border border-orange-200 rounded-2xl p-4">
                            <p class="font-bold text-orange-700 mb-2">
                                Data Rujukan
                            </p>

                            <p>
                                <span class="font-semibold text-slate-800">Tujuan Rujukan:</span>
                                {{ $item->tujuan_rujukan ?? '-' }}
                            </p>

                            <p class="mt-1">
                                <span class="font-semibold text-slate-800">Alasan Rujukan:</span>
                                {{ $item->alasan_rujukan ?? '-' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        @empty
            <div class="text-center py-12 text-slate-500">
                Belum ada riwayat kunjungan pasien.
            </div>
        @endforelse
    </div>
</div>

@endsection