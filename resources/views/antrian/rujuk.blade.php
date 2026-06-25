@extends('layouts.app')

@section('title', 'Rujuk Pasien')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-sky-100">

        <h1 class="text-3xl font-bold text-slate-800 mb-6">
            Form Rujukan Pasien
        </h1>

        <div class="mb-6">
            <p>
                <strong>Nomor Antrian :</strong>
                {{ $antrian->nomor_antrian }}
            </p>

            <p>
                <strong>Nama Pasien :</strong>
                {{ $antrian->pasien->nama }}
            </p>

            <p>
                <strong>Keluhan :</strong>
                {{ $antrian->keluhan }}
            </p>
        </div>

        <form action="/antrian/{{ $antrian->id }}/rujuk" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Tujuan Rujukan
                </label>

                <input
                    type="text"
                    name="tujuan_rujukan"
                    class="w-full border border-slate-300 rounded-xl p-3"
                    placeholder="Contoh: RSUD Pangkep"
                    required>
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">
                    Alasan Rujukan
                </label>

                <textarea
                    name="alasan_rujukan"
                    rows="5"
                    class="w-full border border-slate-300 rounded-xl p-3"
                    placeholder="Contoh: Memerlukan pemeriksaan spesialis jantung"
                    required></textarea>
            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl">
                    Simpan Rujukan
                </button>

                <a href="/antrian"
                   class="bg-slate-500 hover:bg-slate-600 text-white px-6 py-3 rounded-xl">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection