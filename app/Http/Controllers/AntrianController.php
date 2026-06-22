<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;

class AntrianController extends Controller
{
    public function index()
    {
        $status = request('status');
        $search = request('search');

        $antrian = Pendaftaran::with('pasien')
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nomor_antrian', 'like', '%' . $search . '%')
                    ->orWhere('keluhan', 'like', '%' . $search . '%')
                    ->orWhereHas('pasien', function ($pasien) use ($search) {
                        $pasien->where('nama', 'like', '%' . $search . '%')
                                ->orWhere('nrm', 'like', '%' . $search . '%');
                    });
                });
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('antrian.index', compact('antrian', 'status', 'search'));
    }

    public function updateStatus($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status' => request('status')
        ]);

        return redirect('/antrian')->with('success', 'Status antrian berhasil diperbarui.');
    }
}