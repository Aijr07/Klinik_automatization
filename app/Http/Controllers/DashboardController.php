<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();

        $antrianHariIni = Pendaftaran::whereDate('tanggal', now()->toDateString())
            ->count();

        $menunggu = Pendaftaran::where('status', 'menunggu')
            ->whereDate('tanggal', now()->toDateString())
            ->count();

        $dipanggil = Pendaftaran::where('status', 'dipanggil')
            ->whereDate('tanggal', now()->toDateString())
            ->count();

        $selesai = Pendaftaran::where('status', 'selesai')
            ->whereDate('tanggal', now()->toDateString())
            ->count();

        $batal = Pendaftaran::where('status', 'batal')
            ->whereDate('tanggal', now()->toDateString())
            ->count();

        $antrianTerbaru = Pendaftaran::with('pasien')
            ->whereDate('tanggal', now()->toDateString())
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $kunjunganPerHari = Pendaftaran::selectRaw('tanggal, COUNT(*) as total')
        ->whereDate('tanggal', '>=', now()->subDays(6)->toDateString())
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'asc')
        ->get();

        $labelTanggal = $kunjunganPerHari->pluck('tanggal');
        $dataKunjungan = $kunjunganPerHari->pluck('total');

        return view('dashboard', compact(
            'totalPasien',
            'antrianHariIni',
            'menunggu',
            'dipanggil',
            'selesai',
            'batal',
            'antrianTerbaru',
            'labelTanggal',
            'dataKunjungan'
        ));
    }
}