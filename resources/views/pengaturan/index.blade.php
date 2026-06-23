<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Pengaturan Klinik
        </h1>

        <a href="/"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Dashboard
        </a>

    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="/pengaturan-klinik/update"
          method="POST"
          class="bg-white p-6 rounded shadow">

        @csrf

        <label class="font-semibold">
            Nama Klinik
        </label>

        <input
            type="text"
            name="nama_klinik"
            value="{{ $pengaturan->nama_klinik }}"
            class="w-full border p-2 mb-4 rounded">

        <label class="font-semibold">
            Alamat
        </label>

        <textarea
            name="alamat"
            class="w-full border p-2 mb-4 rounded"
            rows="3">{{ $pengaturan->alamat }}</textarea>

        <label class="font-semibold">
            Telepon
        </label>

        <input
            type="text"
            name="telepon"
            value="{{ $pengaturan->telepon }}"
            class="w-full border p-2 mb-4 rounded">

        <label class="font-semibold">
            Kuota Harian
        </label>

        <input
            type="number"
            name="kuota_harian"
            value="{{ $pengaturan->kuota_harian }}"
            class="w-full border p-2 mb-4 rounded">

        <label class="font-semibold">
            Jam Operasional
        </label>

        <textarea
            name="jam_operasional"
            class="w-full border p-2 mb-4 rounded"
            rows="5">{{ $pengaturan->jam_operasional }}</textarea>

        <button
            type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded">
            Simpan Pengaturan
        </button>

    </form>

</div>

</body>
</html>