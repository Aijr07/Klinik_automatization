<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Edit Jadwal Dokter</h1>

    <form action="/jadwal-dokter/{{ $jadwal->id }}/update" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <label>Nama Dokter</label>
        <input type="text" name="nama_dokter" value="{{ $jadwal->nama_dokter }}" class="w-full border p-2 mb-4 rounded" required>

        <label>Hari</label>
        <input type="text" name="hari" value="{{ $jadwal->hari }}" class="w-full border p-2 mb-4 rounded" required>

        <label>Jam Mulai</label>
        <input type="time" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" class="w-full border p-2 mb-4 rounded" required>

        <label>Jam Selesai</label>
        <input type="time" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" class="w-full border p-2 mb-4 rounded" required>

        <label>Keterangan</label>
        <textarea name="keterangan" class="w-full border p-2 mb-4 rounded">{{ $jadwal->keterangan }}</textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

        <a href="/jadwal-dokter" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
            Batal
        </a>
    </form>
</div>

</body>
</html>