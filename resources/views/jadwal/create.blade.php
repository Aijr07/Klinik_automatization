@extends('layouts.app')

@section('title', 'Tambah Jadwal Dokter')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Tambah Jadwal Dokter</h1>
            <p class="text-slate-500 mt-1">Tambahkan jadwal praktik dokter baru.</p>
        </div>

        <a href="/jadwal-dokter"
           class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-3 rounded-2xl transition">
            ← Kembali
        </a>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-8">
    <form action="/jadwal-dokter/store" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Dokter
                </label>
                <input type="text" name="nama_dokter"
                       class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                       required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Hari
                </label>
                <input type="text" name="hari" placeholder="Contoh: Senin - Jumat"
                       class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                       required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Jam Mulai
                </label>
                <input type="time" name="jam_mulai"
                       class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                       required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Jam Selesai
                </label>
                <input type="time" name="jam_selesai"
                       class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                       required>
            </div>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Keterangan
            </label>
            <textarea name="keterangan" rows="4"
                      class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"></textarea>
        </div>

        <div class="flex gap-4 mt-8">
            <button class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-8 py-3 rounded-2xl shadow transition">
                Simpan
            </button>

            <a href="/jadwal-dokter"
               class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-8 py-3 rounded-2xl transition">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection