@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Jadwal Dokter</h1>
            <p class="text-slate-500 mt-1">Kelola jadwal praktik dokter klinik.</p>
        </div>

        <a href="/jadwal-dokter/create"
           class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-5 py-3 rounded-2xl shadow transition">
            + Tambah Jadwal
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl mb-6 shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">
    <table class="w-full">
        <thead class="bg-sky-100 text-slate-700">
            <tr>
                <th class="p-4 text-left">Nama Dokter</th>
                <th class="p-4 text-left">Hari</th>
                <th class="p-4 text-left">Jam Mulai</th>
                <th class="p-4 text-left">Jam Selesai</th>
                <th class="p-4 text-left">Keterangan</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($jadwal as $item)
            <tr class="border-b border-sky-50 hover:bg-sky-50 transition">
                <td class="p-4 font-semibold text-blue-600">
                    {{ $item->nama_dokter }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->hari }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->jam_mulai }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->jam_selesai }}
                </td>

                <td class="p-4 text-slate-700">
                    {{ $item->keterangan }}
                </td>

                <td class="p-4">
                    <div class="flex justify-center gap-2">
                        <a href="/jadwal-dokter/{{ $item->id }}/edit"
                           class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-4 py-2 rounded-xl font-semibold transition">
                            Edit
                        </a>

                        <form action="/jadwal-dokter/{{ $item->id }}/delete" method="POST">
                            @csrf

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus jadwal dokter ini?')"
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
                    Belum ada jadwal dokter
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection