<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Edit Data Pasien</h1>

    <form action="/pasien/{{ $pasien->id }}/update" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <label>Nama</label>
        <input type="text" name="nama" value="{{ $pasien->nama }}" class="w-full border p-2 mb-4 rounded">

        <label>Umur</label>
        <input type="number" name="umur" value="{{ $pasien->umur }}" class="w-full border p-2 mb-4 rounded">

        <label>Alamat</label>
        <textarea name="alamat" class="w-full border p-2 mb-4 rounded">{{ $pasien->alamat }}</textarea>

        <label>Telepon</label>
        <input type="text" name="telepon" value="{{ $pasien->telepon }}" class="w-full border p-2 mb-4 rounded">

        <label>Nomor WA</label>
        <input type="text" name="nomor_wa" value="{{ $pasien->nomor_wa }}" class="w-full border p-2 mb-4 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>

        <a href="/pasien/{{ $pasien->id }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
            Batal
        </a>
    </form>
</div>

</body>
</html>