@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Edit Data Pasien
            </h1>
            <p class="text-slate-500 mt-1">
                Perbarui informasi pasien yang terdaftar di klinik.
            </p>
        </div>

        <a href="/pasien/{{ $pasien->id }}"
           class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-3 rounded-2xl transition">
            ← Kembali
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-8">

    <form action="/pasien/{{ $pasien->id }}/update" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Pasien
                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ $pasien->nama }}"
                    class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Umur
                </label>

                <input
                    type="number"
                    name="umur"
                    value="{{ $pasien->umur }}"
                    class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                    required>
            </div>

        </div>

        <div class="mt-6">
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Alamat
            </label>

            <textarea
                name="alamat"
                rows="4"
                class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">{{ $pasien->alamat }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nomor Telepon
                </label>

                <input
                    type="text"
                    name="telepon"
                    value="{{ $pasien->telepon }}"
                    class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nomor WhatsApp
                </label>

                <input
                    type="text"
                    name="nomor_wa"
                    value="{{ $pasien->nomor_wa }}"
                    class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition">
            </div>

        </div>

        <div class="flex gap-4 mt-8">

            <button
                type="submit"
                class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-8 py-3 rounded-2xl shadow transition">
                Simpan Perubahan
            </button>

            <a href="/pasien/{{ $pasien->id }}"
               class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-8 py-3 rounded-2xl transition">
                Batal
            </a>

        </div>

    </form>

</div>

@endsection