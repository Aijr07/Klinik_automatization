@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-6">

        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

            <div>

                <h1 class="text-3xl font-bold text-slate-800">

                    Jadwal Praktik Dokter

                </h1>

                <p class="text-slate-500 mt-2">

                    Kelola hari dan jam praktik setiap dokter.

                </p>

            </div>

            <a href="{{ route('jadwal.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-6 py-3 rounded-2xl shadow transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>

                </svg>

                Tambah Jadwal

            </a>

        </div>

    </div>


    {{-- Alert --}}
    @if(session('success'))

        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 text-emerald-700">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 text-red-700">

            {{ session('error') }}

        </div>

    @endif


    {{-- Filter --}}
    <div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-6">

        <form method="GET">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari dokter atau hari praktik..."
                    class="flex-1 border border-sky-100 bg-sky-50 rounded-2xl px-5 py-3 focus:ring-2 focus:ring-sky-400">

                <button
                    class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-2xl">

                    Cari

                </button>

                @if(request('search'))

                    <a href="{{ route('jadwal.index') }}"
                       class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl text-center">

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- Tabel --}}
    <div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-sky-100">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Dokter
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Hari Praktik
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Jam Praktik
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Keterangan
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                @forelse($jadwal as $index => $item)

<tr class="hover:bg-sky-50 transition">

    {{-- Nomor --}}
    <td class="px-6 py-5 font-medium text-slate-700">

        {{ $index + 1 }}

    </td>


    {{-- Dokter --}}
    <td class="px-6 py-5">

        <div class="font-semibold text-sky-700">

            {{ $item->dokter->nama_dokter ?? $item->nama_dokter }}

        </div>

        @if(optional($item->dokter)->spesialis)

            <div class="text-sm text-slate-500 mt-1">

                {{ $item->dokter->spesialis }}

            </div>

        @endif

    </td>


    {{-- Hari Praktik --}}
    <td class="px-6 py-5">

        <span class="inline-flex items-center px-4 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">

            {{ $item->hari }}

        </span>

    </td>


    {{-- Jam Praktik --}}
    <td class="px-6 py-5">

        <div class="font-medium text-slate-700">

            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
            -
            {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}

        </div>

    </td>


    {{-- Keterangan --}}
    <td class="px-6 py-5">

        @if(!empty($item->keterangan))

            <span class="text-slate-700">

                {{ $item->keterangan }}

            </span>

        @else

            <span class="italic text-slate-400">

                Tidak ada keterangan

            </span>

        @endif

    </td>


    {{-- Aksi --}}
    <td class="px-6 py-5">

        <div class="flex justify-center gap-2">

            <a href="{{ route('jadwal.edit',$item->id) }}"
               class="inline-flex items-center px-4 py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-white transition">

                Edit

            </a>

            <form
                action="{{ route('jadwal.destroy',$item->id) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus jadwal praktik ini?')">

                @csrf

                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white transition">

                    Hapus

                </button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="6" class="px-6 py-12 text-center">

        <div class="flex flex-col items-center">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-20 h-20 text-slate-300 mb-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z"/>

            </svg>

            <h3 class="text-xl font-semibold text-slate-700">

                Belum Ada Jadwal Praktik

            </h3>

            <p class="text-slate-500 mt-2 mb-6">

                Silakan tambahkan jadwal praktik dokter terlebih dahulu.

            </p>

            <a href="{{ route('jadwal.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-6 py-3 rounded-2xl shadow transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>

                </svg>

                Tambah Jadwal

            </a>

        </div>

    </td>

</tr>

@endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection