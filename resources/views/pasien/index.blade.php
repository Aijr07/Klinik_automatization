<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-5">
        <h1 class="text-3xl font-bold">
            Data Pasien
        </h1>

        <a href="/"
           class="bg-blue-600 text-white px-4 py-2 rounded">
           Dashboard
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">

                <tr>
                    <th class="p-3">Aksi</th>
                    <th class="p-3">NRM</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Umur</th>
                    <th class="p-3">Telepon</th>
                    <th class="p-3">Alamat</th>
                </tr>

            </thead>

            <tbody>

            @foreach($pasien as $item)

                <tr class="border-b">

                    <td class="p-3">
                        {{ $item->nrm }}
                    </td>

                    <td class="p-3">
                        {{ $item->nama }}
                    </td>

                    <td class="p-3">
                        {{ $item->umur }}
                    </td>

                    <td class="p-3">
                        {{ $item->telepon }}
                    </td>

                    <td class="p-3">
                        {{ $item->alamat }}
                    </td>
                    <td class="p-3">
                        <a href="/pasien/{{ $item->id }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded">
                            Detail
                        </a>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>