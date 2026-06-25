@extends('layouts.app')

@section('title', 'Pengaturan Klinik')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Pengaturan Klinik
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola informasi dan konfigurasi klinik.
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

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-8">

    <form action="/pengaturan-klinik/update" method="POST">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Klinik
                </label>

                <input
                    type="text"
                    name="nama_klinik"
                    value="{{ $pengaturan->nama_klinik }}"
                    class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nomor Telepon
                </label>

                <input
                    type="text"
                    name="telepon"
                    value="{{ $pengaturan->telepon }}"
                    class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">
            </div>

        </div>

        <div class="mt-6">

            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Alamat Klinik
            </label>

            <textarea
                name="alamat"
                rows="4"
                class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">{{ $pengaturan->alamat }}</textarea>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Kuota Harian Pasien
                </label>

                <input
                    type="number"
                    name="kuota_harian"
                    value="{{ $pengaturan->kuota_harian }}"
                    class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">
            </div>

            <div class="bg-sky-50 rounded-3xl p-5 border border-sky-100">
                <div class="text-sm text-slate-500">
                    Informasi
                </div>

                <div class="mt-2 text-slate-700">
                    Pengaturan ini digunakan untuk membatasi jumlah pasien yang dapat mendaftar dalam satu hari.
                </div>
            </div>

        </div>

        <label class="font-semibold">
    Status Pendaftaran
</label>

<select
    name="status_pendaftaran"
    class="w-full border p-2 mb-4 rounded">

    <option value="buka" {{ $pengaturan->status_pendaftaran == 'buka' ? 'selected' : '' }}>
        Buka
    </option>

    <option value="tutup" {{ $pengaturan->status_pendaftaran == 'tutup' ? 'selected' : '' }}>
        Tutup
    </option>

</select>

<label class="font-semibold">
    Alasan Tutup
</label>

<textarea
    name="alasan_tutup"
    class="w-full border p-2 mb-4 rounded"
    rows="3"
    placeholder="Contoh: Dokter tidak praktik hari ini">{{ $pengaturan->alasan_tutup }}</textarea>

        <div class="mt-6">

            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Jam Operasional Klinik
            </label>

            <textarea
                name="jam_operasional"
                rows="5"
                class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">{{ $pengaturan->jam_operasional }}</textarea>

        </div>

        <div class="flex gap-4 mt-8">

            <button
                type="submit"
                class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-8 py-3 rounded-2xl shadow transition">
                Simpan Pengaturan
            </button>

            <a href="/"
               class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-8 py-3 rounded-2xl transition">
                Batal
            </a>

        </div>

    </form>

</div>

@endsection