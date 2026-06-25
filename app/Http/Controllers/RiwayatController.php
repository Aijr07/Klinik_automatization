<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;

class RiwayatController extends Controller
{
    public function index()
    {
        $search = request('search');
        $tanggal = request('tanggal');

        $riwayat = Pendaftaran::with('pasien')
            ->whereIn('status', ['selesai', 'dirujuk'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nrm', 'like', '%' . $search . '%');
                });
            })
            ->when($tanggal, function ($query) use ($tanggal) {
                $query->whereDate('tanggal', $tanggal);
            })
            ->orderBy('id', 'desc')
            ->get();

            $totalRiwayat = $riwayat->count();

            $totalPasienBaru = $riwayat
                ->where('jenis_pasien', 'baru')
                ->count();

            $totalPasienLama = $riwayat
                ->where('jenis_pasien', 'lama')
                ->count();

        return view('riwayat.index', compact(
            'riwayat',
            'search',
            'tanggal',
            'totalRiwayat',
            'totalPasienBaru',
            'totalPasienLama'
        ));
    }

    public function export()
    {
        $riwayat = Pendaftaran::with('pasien')
            ->whereIn('status', ['selesai', 'dirujuk'])
            ->orderBy('tanggal', 'desc')
            ->get();

        $filename = 'riwayat_kunjungan.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($riwayat) {
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

            foreach ($riwayat as $item) {
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
}