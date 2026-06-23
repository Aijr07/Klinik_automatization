<?php

namespace App\Http\Controllers;

use App\Models\PengaturanKlinik;

class PengaturanKlinikController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanKlinik::first();

        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update()
    {
        $pengaturan = PengaturanKlinik::first();

        $pengaturan->update([
            'nama_klinik' => request('nama_klinik'),
            'alamat' => request('alamat'),
            'telepon' => request('telepon'),
            'kuota_harian' => request('kuota_harian'),
            'jam_operasional' => request('jam_operasional'),
        ]);

        return redirect('/pengaturan-klinik')
            ->with('success', 'Pengaturan klinik berhasil diperbarui.');
    }
}