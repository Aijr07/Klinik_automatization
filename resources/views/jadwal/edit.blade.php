@extends('layouts.app')

@section('title', 'Edit Jadwal Dokter')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-3xl shadow-sm border border-sky-100 overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-sky-500 to-blue-600 px-8 py-6">

            <h1 class="text-2xl font-bold text-white">

                Edit Jadwal Praktik Dokter

            </h1>

            <p class="text-sky-100 mt-2">

                Perbarui hari praktik, jam praktik, maupun informasi dokter.

            </p>

        </div>

        {{-- Form --}}
        <form
            action="{{ route('jadwal.update', $jadwal->id) }}"
            method="POST"
            class="p-8">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Dokter --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Dokter

                    </label>

                    <select
                        name="dokter_id"
                        required
                        class="w-full border border-sky-100 bg-sky-50 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-400">

                        <option value="">

                            -- Pilih Dokter --

                        </option>

                        @foreach($dokter as $d)

                            <option
                                value="{{ $d->id }}"
                                {{ old('dokter_id', $jadwal->dokter_id) == $d->id ? 'selected' : '' }}>

                                {{ $d->nama_dokter }}

                                @if($d->spesialis)

                                    - {{ $d->spesialis }}

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
                        class="w-full border border-sky-100 bg-sky-50 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-400">

                        @php

                            $hariList = [
                                'Senin',
                                'Selasa',
                                'Rabu',
                                'Kamis',
                                'Jumat',
                                'Sabtu',
                                'Minggu'
                            ];

                        @endphp

                        @foreach($hariList as $hari)

                            <option
                                value="{{ $hari }}"
                                {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>

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
                            {{-- Jam Mulai & Jam Selesai --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                {{-- Jam Mulai --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Jam Mulai

                    </label>

                    <input
                        type="time"
                        name="jam_mulai"
                        value="{{ old('jam_mulai', $jadwal->jam_mulai) }}"
                        required
                        class="w-full border border-sky-100 bg-sky-50 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-400">

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
                        value="{{ old('jam_selesai', $jadwal->jam_selesai) }}"
                        required
                        class="w-full border border-sky-100 bg-sky-50 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-400">

                    @error('jam_selesai')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

            </div>


            {{-- Keterangan --}}
            <div class="mt-6">

                <label class="block text-sm font-semibold text-slate-700 mb-2">

                    Keterangan

                </label>

                <textarea
                    name="keterangan"
                    rows="4"
                    placeholder="Contoh: Poli Umum, Poli Gigi, Praktik Malam, dll."
                    class="w-full border border-sky-100 bg-sky-50 rounded-2xl px-4 py-3 resize-none focus:ring-2 focus:ring-sky-400">{{ old('keterangan', $jadwal->keterangan) }}</textarea>

                @error('keterangan')

                    <p class="text-red-500 text-sm mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- Informasi --}}
            <div class="mt-8 rounded-2xl border border-amber-200 bg-amber-50 p-5">

                <div class="flex gap-3">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-amber-600 flex-shrink-0"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z"/>

                    </svg>

                    <div>

                        <h3 class="font-semibold text-amber-800">

                            Informasi Jadwal

                        </h3>

                        <p class="text-sm text-amber-700 mt-2 leading-relaxed">

                            Perubahan hari praktik atau jam praktik akan
                            mempengaruhi jadwal pendaftaran pasien yang
                            dihasilkan secara otomatis oleh sistem.

                        </p>

                        <p class="text-sm text-amber-700 mt-2 leading-relaxed">

                            Jika dokter memiliki lebih dari satu hari praktik,
                            setiap hari harus dibuat sebagai satu data jadwal
                            yang terpisah.

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

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection