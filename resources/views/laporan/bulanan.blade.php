@extends('layouts.app')

@section('title', 'Laporan Bulanan')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <h1 class="text-3xl font-bold text-slate-800">
        Laporan Bulanan
    </h1>

    <p class="text-slate-500 mt-1">
        Statistik kunjungan pasien per bulan.
    </p>
</div>

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">

    <form method="GET" action="/laporan-bulanan" class="flex gap-3">

        <select
            name="bulan"
            class="border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl">

            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}"
                    {{ $bulan == $i ? 'selected' : '' }}>
                    Bulan {{ $i }}
                </option>
            @endfor

        </select>

        <input
            type="number"
            name="tahun"
            value="{{ $tahun }}"
            class="border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl">

        <button
            class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-2xl shadow transition">
            Filter
        </button>

    </form>

</div>

<div class="grid grid-cols-1 md:grid-cols-5 gap-6">

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Total Kunjungan</p>
        <h3 class="text-4xl font-bold text-blue-600 mt-2">
            {{ $total }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Pasien Baru</p>
        <h3 class="text-4xl font-bold text-indigo-500 mt-2">
            {{ $pasienBaru }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Pasien Lama</p>
        <h3 class="text-4xl font-bold text-purple-500 mt-2">
            {{ $pasienLama }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Selesai</p>
        <h3 class="text-4xl font-bold text-green-500 mt-2">
            {{ $selesai }}
        </h3>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-sky-100">
        <p class="text-slate-500">Batal</p>
        <h3 class="text-4xl font-bold text-red-500 mt-2">
            {{ $batal }}
        </h3>
    </div>

</div>

@endsection