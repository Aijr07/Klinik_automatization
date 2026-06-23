<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;

class RiwayatController extends Controller
{
    public function index()
    {
        $search = request('search');

        $riwayat = Pendaftaran::with('pasien')
            ->where('status', 'selesai')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('nrm', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('riwayat.index', compact(
            'riwayat',
            'search'
        ));
    }
}