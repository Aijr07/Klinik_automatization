<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Antrian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">
            Data Antrian Pasien
        </h1>

        <a href="/"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">

    <div class="mb-4 flex gap-2">
        <a href="/antrian" class="px-4 py-2 rounded bg-gray-600 text-white">Semua</a>
        <a href="/antrian?status=menunggu" class="px-4 py-2 rounded bg-yellow-500 text-white">Menunggu</a>
        <a href="/antrian?status=dipanggil" class="px-4 py-2 rounded bg-blue-500 text-white">Dipanggil</a>
        <a href="/antrian?status=selesai" class="px-4 py-2 rounded bg-green-500 text-white">Selesai</a>
        <a href="/antrian?status=batal" class="px-4 py-2 rounded bg-red-500 text-white">Batal</a>
    </div>

    <form method="GET" action="/antrian" class="mb-4 flex gap-2">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari nama, NRM, nomor antrian, keluhan..."
            class="border px-4 py-2 rounded w-full"
        >

        @if($status)
            <input type="hidden" name="status" value="{{ $status }}">
        @endif

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Cari
        </button>
    </form>

        <table class="w-full">

            <thead class="bg-gray-200">

                <tr>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Nomor Antrian</th>
                    <th class="p-3 text-left">NRM</th>
                    <th class="p-3 text-left">Nama Pasien</th>
                    <th class="p-3 text-left">Keluhan</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($antrian as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        {{ $item->tanggal }}
                    </td>

                    <td class="p-3 font-semibold">
                        {{ $item->nomor_antrian }}
                    </td>

                    <td class="p-3">
                        {{ $item->pasien->nrm ?? '-' }}
                    </td>

                    <td class="p-3">
                        @if($item->pasien)
                            <a href="/pasien/{{ $item->pasien->id }}" class="text-blue-600 hover:underline">
                                {{ $item->pasien->nama }}
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <td class="p-3">
                        {{ $item->keluhan }}
                    </td>

                    <td class="p-3">

                        @if($item->status == 'menunggu')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                Menunggu
                            </span>

                        @elseif($item->status == 'dipanggil')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                                Dipanggil
                            </span>

                        @elseif($item->status == 'selesai')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                Selesai
                            </span>

                        @elseif($item->status == 'batal')
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded">
                                Batal
                            </span>

                        @endif

                    </td>

                    <td class="p-3">

                        <div class="flex flex-wrap gap-2 justify-center">

                            <form action="/antrian/{{ $item->id }}/status" method="POST">
                                @csrf

                                <input type="hidden"
                                       name="status"
                                       value="dipanggil">

                                <button
                                    type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Panggil
                                </button>
                            </form>

                            <form action="/antrian/{{ $item->id }}/status" method="POST">
                                @csrf

                                <input type="hidden"
                                       name="status"
                                       value="selesai">

                                <button
                                    type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                    Selesai
                                </button>
                            </form>

                            <form action="/antrian/{{ $item->id }}/status" method="POST">
                                @csrf

                                <input type="hidden"
                                       name="status"
                                       value="batal">

                                <button
                                    type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                                    onclick="return confirm('Yakin ingin membatalkan antrian ini?')">
                                    Batal
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7"
                        class="text-center p-5 text-gray-500">
                        Belum ada data antrian
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>