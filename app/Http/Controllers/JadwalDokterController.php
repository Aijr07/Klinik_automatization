<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwal = JadwalDokter::orderBy('id', 'desc')->get();

        return view('jadwal.index', compact('jadwal'));
    }
    public function create()
    {
        return view('jadwal.create');
    }

    public function store()
    {
        JadwalDokter::create([
            'nama_dokter' => request('nama_dokter'),
            'hari' => request('hari'),
            'jam_mulai' => request('jam_mulai'),
            'jam_selesai' => request('jam_selesai'),
            'keterangan' => request('keterangan'),
        ]);

        return redirect('/jadwal-dokter')
            ->with('success', 'Jadwal dokter berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        return view('jadwal.edit', compact('jadwal'));
    }

    public function update($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $jadwal->update([
            'nama_dokter' => request('nama_dokter'),
            'hari' => request('hari'),
            'jam_mulai' => request('jam_mulai'),
            'jam_selesai' => request('jam_selesai'),
            'keterangan' => request('keterangan'),
        ]);

        return redirect('/jadwal-dokter')
            ->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $jadwal->delete();

        return redirect('/jadwal-dokter')
            ->with('success', 'Jadwal dokter berhasil dihapus.');
    }
}