<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Http;

class AntrianController extends Controller
{
    public function index()
    {
        $status = request('status');
        $search = request('search');
        $jenis = request('jenis');

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
            ->when($jenis, function ($query) use ($jenis) {
                return $query->where('jenis_pasien', $jenis);
            })

            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('antrian.index', compact('antrian', 'status', 'search', 'jenis'));
    }

    public function updateStatus($id)
    {
        $pendaftaran = Pendaftaran::with('pasien')->findOrFail($id);

        $status = request('status');

        $pendaftaran->update([
            'status' => $status
        ]);

        if ($status == 'dipanggil') {
            Http::post(env('N8N_WEBHOOK_PANGGIL'), [
                'nomor_wa' => $pendaftaran->pasien->nomor_wa,
                'nama' => $pendaftaran->pasien->nama,
                'nomor_antrian' => $pendaftaran->nomor_antrian,
            ]);
        }

        return redirect('/antrian')
            ->with('success', 'Status antrian berhasil diperbarui.');
    }
    
    public function formRujuk($id)
    {
        $antrian = Pendaftaran::with('pasien')->findOrFail($id);

        return view('antrian.rujuk', compact('antrian'));
    }

    public function simpanRujuk($id)
    {
        $antrian = Pendaftaran::findOrFail($id);

        $antrian->update([
            'status' => 'dirujuk',
            'tujuan_rujukan' => request('tujuan_rujukan'),
            'alasan_rujukan' => request('alasan_rujukan'),
        ]);

        return redirect('/antrian')
            ->with('success', 'Pasien berhasil dirujuk.');
    }
}