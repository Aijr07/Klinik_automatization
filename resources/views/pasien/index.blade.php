@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Data Pasien
            </h1>
            <p class="text-slate-500 mt-1">
                Daftar seluruh data pasien yang terdaftar di klinik.
            </p>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">
    <form method="GET" action="/pasien" class="flex gap-3">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari NRM, nama, telepon, nomor WA, alamat..."
            class="w-full border border-sky-100 bg-sky-50/60 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
        >

        <button class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-2xl shadow transition">
            Cari
        </button>
    </form>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">

    <table class="w-full">
        <thead class="bg-sky-100 text-slate-700">
            <tr>
                <th class="p-4 text-left">NRM</th>
                <th class="p-4 text-left">Nama</th>
                <th class="p-4 text-left">Umur</th>
                <th class="p-4 text-left">Telepon</th>
                <th class="p-4 text-left">Alamat</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($pasien as $item)
            <tr class="border-b border-sky-50 hover:bg-sky-50 transition">

                <td class="p-4 font-semibold text-blue-600">
                    {{ $item->nrm }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->nama }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->umur }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->telepon }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->alamat }}
                </td>

                <td class="p-4 text-center">
                    <a href="/pasien/{{ $item->id }}"
                       class="inline-block bg-sky-100 hover:bg-sky-200 text-sky-700 px-4 py-2 rounded-xl font-semibold transition">
                        Detail
                    </a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

</div>

@endsection