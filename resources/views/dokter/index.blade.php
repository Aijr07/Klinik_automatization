@extends('layouts.app')

@section('title', 'Master Dokter')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Master Dokter
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola data dokter yang bertugas di klinik.
            </p>

        </div>

        <a href="/dokter/create"
           class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-5 py-3 rounded-2xl shadow transition">

            + Tambah Dokter

        </a>

    </div>

</div>

@if(session('success'))

<div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl mb-6 shadow-sm">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-3xl p-5 shadow-sm border border-sky-100 mb-6">

    <form method="GET" action="/dokter">

        <div class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama dokter atau spesialis..."
                class="flex-1 border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400">

            <button
                class="bg-sky-500 hover:bg-sky-600 text-white px-6 rounded-2xl">

                Cari

            </button>

        </div>

    </form>

</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-sky-100 text-slate-700">

                <tr>

                    <th class="p-4 text-left">Nama Dokter</th>

                    <th class="p-4 text-left">Spesialis</th>

                    <th class="p-4 text-left">Nomor SIP</th>

                    <th class="p-4 text-left">Telepon</th>

                    <th class="p-4 text-center">Status</th>

                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($dokter as $item)

            <tr class="border-b border-sky-50 hover:bg-sky-50 transition">

                <td class="p-4">

                    <span class="font-semibold text-blue-600">

                        {{ $item->nama_dokter }}

                    </span>

                </td>

                <td class="p-4">

                    {{ $item->spesialis ?? '-' }}

                </td>

                <td class="p-4">

                    {{ $item->nomor_sip ?? '-' }}

                </td>

                <td class="p-4">

                    {{ $item->telepon ?? '-' }}

                </td>

                <td class="p-4 text-center">

                    @if($item->status)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                            Aktif

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">

                            Nonaktif

                        </span>

                    @endif

                </td>

                <td class="p-4">

                    <div class="flex justify-center gap-2">

                        <a href="/dokter/{{ $item->id }}/edit"

                           class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-4 py-2 rounded-xl font-semibold transition">

                            Edit

                        </a>

                        <form action="/dokter/{{ $item->id }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button

                                onclick="return confirm('Yakin ingin menghapus dokter ini?')"

                                class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-xl font-semibold transition">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center p-8 text-slate-500">

                    Belum ada data dokter

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection