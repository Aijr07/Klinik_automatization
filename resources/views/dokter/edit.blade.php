@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('content')

<div class="mb-8 bg-white rounded-3xl p-6 shadow-sm border border-sky-100">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Dokter
            </h1>

            <p class="text-slate-500 mt-1">
                Perbarui informasi dokter.
            </p>

        </div>

        <a href="/dokter"
           class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-3 rounded-2xl transition">

            Kembali

        </a>

    </div>

</div>

<div class="bg-white rounded-3xl shadow-sm border border-sky-100 p-8">

<form action="/dokter/{{ $dokter->id }}" method="POST">

@csrf
@method('PUT')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

<div>

<label class="block text-sm font-semibold text-slate-700 mb-2">

Nama Dokter

</label>

<input
type="text"
name="nama_dokter"
value="{{ old('nama_dokter',$dokter->nama_dokter) }}"
required
class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl">

</div>

<div>

<label class="block text-sm font-semibold text-slate-700 mb-2">

Spesialis

</label>

<input
type="text"
name="spesialis"
value="{{ old('spesialis',$dokter->spesialis) }}"
class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl">

</div>

<div>

<label class="block text-sm font-semibold text-slate-700 mb-2">

Nomor SIP

</label>

<input
type="text"
name="nomor_sip"
value="{{ old('nomor_sip',$dokter->nomor_sip) }}"
class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl">

</div>

<div>

<label class="block text-sm font-semibold text-slate-700 mb-2">

Nomor Telepon

</label>

<input
type="text"
name="telepon"
value="{{ old('telepon',$dokter->telepon) }}"
class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl">

</div>

<div>

<label class="block text-sm font-semibold text-slate-700 mb-2">

Status

</label>

<select
name="status"
class="w-full border border-sky-100 bg-sky-50 px-4 py-3 rounded-2xl">

<option value="1" {{ $dokter->status ? 'selected' : '' }}>
Aktif
</option>

<option value="0" {{ !$dokter->status ? 'selected' : '' }}>
Nonaktif
</option>

</select>

</div>

</div>

<div class="flex gap-4 mt-8">

<button
type="submit"
class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-8 py-3 rounded-2xl shadow transition">

Update Dokter

</button>

<a href="/dokter"
class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-8 py-3 rounded-2xl">

Batal

</a>

</div>

</form>

</div>

@endsection