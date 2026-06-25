<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;

class LaporanController extends Controller
{
    public function index()
    {
        $tanggal = request('tanggal') ?? now()->toDateString();

        $total = Pendaftaran::whereDate('tanggal', $tanggal)->count();

        $pasienBaru = Pendaftaran::whereDate('tanggal', $tanggal)
            ->where('jenis_pasien', 'baru')
            ->count();

        $pasienLama = Pendaftaran::whereDate('tanggal', $tanggal)
            ->where('jenis_pasien', 'lama')
            ->count();

        $menunggu = Pendaftaran::whereDate('tanggal', $tanggal)
            ->where('status', 'menunggu')
            ->count();

        $dipanggil = Pendaftaran::whereDate('tanggal', $tanggal)
            ->where('status', 'dipanggil')
            ->count();

        $selesai = Pendaftaran::whereDate('tanggal', $tanggal)
            ->where('status', 'selesai')
            ->count();

        $batal = Pendaftaran::whereDate('tanggal', $tanggal)
            ->where('status', 'batal')
            ->count();

        $data = Pendaftaran::with('pasien')
            ->whereDate('tanggal', $tanggal)
            ->orderBy('id', 'desc')
            ->get();

        return view('laporan.index', compact(
            'tanggal',
            'total',
            'pasienBaru',
            'pasienLama',
            'menunggu',
            'dipanggil',
            'selesai',
            'batal',
            'data'
        ));
    }

    public function export()
    {
        $tanggal = request('tanggal') ?? now()->toDateString();

        $data = Pendaftaran::with('pasien')
            ->whereDate('tanggal', $tanggal)
            ->orderBy('id', 'desc')
            ->get();

        $filename = 'laporan_' . $tanggal . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($data) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Tanggal',
                'Nomor Antrian',
                'NRM',
                'Nama',
                'Keluhan',
                'Jenis Pasien',
                'Status'
            ]);

            foreach ($data as $item) {

                fputcsv($file, [
                    $item->tanggal,
                    $item->nomor_antrian,
                    $item->pasien->nrm ?? '-',
                    $item->pasien->nama ?? '-',
                    $item->keluhan,
                    $item->jenis_pasien,
                    $item->status,
                ]);

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function bulanan()
    {
        $bulan = request('bulan') ?? date('m');
        $tahun = request('tahun') ?? date('Y');

        $data = Pendaftaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        $total = $data->count();

        $pasienBaru = (clone $data)
            ->where('jenis_pasien', 'baru')
            ->count();

        $pasienLama = (clone $data)
            ->where('jenis_pasien', 'lama')
            ->count();

        $selesai = (clone $data)
            ->where('status', 'selesai')
            ->count();

        $batal = (clone $data)
            ->where('status', 'batal')
            ->count();

        return view('laporan.bulanan', compact(
            'bulan',
            'tahun',
            'total',
            'pasienBaru',
            'pasienLama',
            'selesai',
            'batal'
        ));
    }
}