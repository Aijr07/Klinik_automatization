<?php

namespace App\Http\Controllers;

use App\Models\PengaturanKlinik;
use Illuminate\Http\Request;

class PengaturanKlinikController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanKlinik::first();

        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $pengaturan = PengaturanKlinik::first();

        $pengaturan->update([
            'nama_klinik' => request('nama_klinik'),
            'alamat' => request('alamat'),
            'telepon' => request('telepon'),
            'kuota_harian' => request('kuota_harian'),
            'jam_operasional' => request('jam_operasional'),
            'status_pendaftaran' => $request->status_pendaftaran,
            'alasan_tutup' => $request->alasan_tutup,
        ]);

        return redirect('/pengaturan-klinik')
            ->with('success', 'Pengaturan klinik berhasil diperbarui.');

        $request->validate([
            'nama_klinik' => 'required',
            'kuota_harian' => 'required|integer',
            'jam_operasional' => 'required',

            'status_pendaftaran' => 'required|in:buka,tutup',
            'alasan_tutup' => 'nullable|string',
        ]);
    }
}