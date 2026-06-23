<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Jadwal Dokter
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="/"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Dashboard
        </a>

        <a href="/jadwal-dokter/create"
            class="bg-green-600 text-white px-4 py-2 rounded">
            Tambah Jadwal
        </a>

    </div>

    <div class="bg-white rounded shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Nama Dokter</th>
                    <th class="p-3 text-left">Hari</th>
                    <th class="p-3 text-left">Jam Mulai</th>
                    <th class="p-3 text-left">Jam Selesai</th>
                    <th class="p-3 text-left">Keterangan</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($jadwal as $item)

                <tr class="border-b">

                    <td class="p-3">
                        {{ $item->nama_dokter }}
                    </td>

                    <td class="p-3">
                        {{ $item->hari }}
                    </td>

                    <td class="p-3">
                        {{ $item->jam_mulai }}
                    </td>

                    <td class="p-3">
                        {{ $item->jam_selesai }}
                    </td>

                    <td class="p-3">
                        {{ $item->keterangan }}
                    </td>
                    <td class="p-3 flex gap-2">
                        <a href="/jadwal-dokter/{{ $item->id }}/edit"
                        class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="/jadwal-dokter/{{ $item->id }}/delete"
                            method="POST">
                            @csrf

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus jadwal dokter ini?')"
                                class="bg-red-600 text-white px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5"
                        class="text-center p-5 text-gray-500">
                        Belum ada jadwal dokter
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>