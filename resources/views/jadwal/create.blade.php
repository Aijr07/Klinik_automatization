@extends('layouts.app')

@section('title', 'Tambah Jadwal Dokter')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-6">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-slate-800">

                    Tambah Jadwal Praktik Dokter

                </h1>

                <p class="text-slate-500 mt-2">

                    Tambahkan satu jadwal praktik untuk satu hari. Jika dokter praktik di beberapa hari, tambahkan kembali jadwal untuk hari lainnya.

                </p>

            </div>

            <a href="{{ route('jadwal.index') }}"
               class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-3 rounded-2xl transition">

                Kembali

            </a>

        </div>

    </div>


    {{-- Form --}}
    <div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-8">

        <form action="{{ route('jadwal.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Dokter --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Dokter

                    </label>

                    <select
                        name="dokter_id"
                        required
                        class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-sky-400">

                        <option value="">-- Pilih Dokter --</option>

                        @foreach($dokter as $dokterItem)

                            <option
                                value="{{ $dokterItem->id }}"
                                {{ old('dokter_id') == $dokterItem->id ? 'selected' : '' }}>

                                {{ $dokterItem->nama_dokter }}

                                @if($dokterItem->spesialis)

                                    - {{ $dokterItem->spesialis }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('dokter_id')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>


                {{-- Hari Praktik --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Hari Praktik

                    </label>

                    <select
                        name="hari"
                        required
                        class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-sky-400">

                        <option value="">Pilih Hari</option>

                        @foreach([
                            'Senin',
                            'Selasa',
                            'Rabu',
                            'Kamis',
                            'Jumat',
                            'Sabtu',
                            'Minggu'
                        ] as $hari)

                            <option
                                value="{{ $hari }}"
                                {{ old('hari') == $hari ? 'selected' : '' }}>

                                {{ $hari }}

                            </option>

                        @endforeach

                    </select>

                    @error('hari')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                                {{-- Jam Mulai --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Jam Mulai

                    </label>

                    <input
                        type="time"
                        name="jam_mulai"
                        value="{{ old('jam_mulai') }}"
                        required
                        class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-sky-400">

                    @error('jam_mulai')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>


                {{-- Jam Selesai --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Jam Selesai

                    </label>

                    <input
                        type="time"
                        name="jam_selesai"
                        value="{{ old('jam_selesai') }}"
                        required
                        class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-sky-400">

                    @error('jam_selesai')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>


                {{-- Keterangan --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Keterangan

                    </label>

                    <textarea
                        name="keterangan"
                        rows="4"
                        placeholder="Contoh: Poli Umum, Poli Gigi, Jadwal Malam, dll."
                        class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl resize-none focus:ring-2 focus:ring-sky-400">{{ old('keterangan') }}</textarea>

                    @error('keterangan')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

            </div>


            {{-- Informasi --}}
            <div class="mt-8 rounded-2xl border border-blue-200 bg-blue-50 p-5">

                <div class="flex gap-3">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-blue-600 flex-shrink-0"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z"/>

                    </svg>

                    <div>

                        <h3 class="font-semibold text-blue-800">

                            Informasi

                        </h3>

                        <p class="text-blue-700 mt-1 text-sm leading-relaxed">

                            Setiap jadwal hanya berlaku untuk <strong>satu hari praktik</strong>.
                            Jika dokter memiliki jadwal pada hari lain (misalnya Senin, Rabu, dan Jumat),
                            tambahkan jadwal baru untuk masing-masing hari.
                            Sistem akan otomatis membuat jadwal pendaftaran pasien melalui proses
                            <strong>Generate Jadwal Pendaftaran</strong>.

                        </p>

                    </div>

                </div>

            </div>
                        {{-- Tombol Aksi --}}
            <div class="mt-10 flex flex-col sm:flex-row justify-end gap-4 border-t border-slate-200 pt-8">

                <a href="{{ route('jadwal.index') }}"
                   class="px-6 py-3 rounded-2xl border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 font-medium transition text-center">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-8 py-3 rounded-2xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-semibold shadow transition">

                    Simpan Jadwal Praktik

                </button>

            </div>

        </form>

    </div>

</div>

@endsection