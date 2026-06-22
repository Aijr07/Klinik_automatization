<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <div class="flex justify-between mb-6">
        <h1 class="text-3xl font-bold">Detail Pasien</h1>

        <a href="/pasien" class="bg-blue-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
        <a href="/pasien/{{ $pasien->id }}/edit"
            class="bg-yellow-500 text-white px-4 py-2 rounded">
            Edit Pasien
        </a>
        <form action="/pasien/{{ $pasien->id }}/delete"
      method="POST"
      class="inline">
    @csrf

    <button
            type="submit"
            onclick="return confirm('Yakin ingin menghapus pasien ini?')"
            class="bg-red-600 text-white px-4 py-2 rounded">
            Hapus Pasien
        </button>
    </form>
    </div>

    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-bold mb-4">{{ $pasien->nama }}</h2>

        <p><b>NRM:</b> {{ $pasien->nrm }}</p>
        <p><b>Umur:</b> {{ $pasien->umur }}</p>
        <p><b>Alamat:</b> {{ $pasien->alamat }}</p>
        <p><b>Telepon:</b> {{ $pasien->telepon }}</p>
        <p><b>Nomor WA:</b> {{ $pasien->nomor_wa }}</p>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <h2 class="text-xl font-bold p-4 border-b">Riwayat Kunjungan</h2>

        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Nomor Antrian</th>
                    <th class="p-3 text-left">Keluhan</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pasien->pendaftaran as $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item->tanggal }}</td>
                        <td class="p-3">{{ $item->nomor_antrian }}</td>
                        <td class="p-3">{{ $item->keluhan }}</td>
                        <td class="p-3">{{ $item->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            Belum ada riwayat kunjungan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>