<?php

namespace App\Http\Controllers;

use App\Models\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::orderBy('id', 'desc')->get();

        return view('pasien.index', compact('pasien'));
    }
    public function show($id)
    {
        $pasien = Pasien::with(['pendaftaran' => function ($query) {
            $query->orderBy('tanggal', 'desc')
                ->orderBy('id', 'desc');
        }])->findOrFail($id);

        return view('pasien.show', compact('pasien'));
    }
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('pasien.edit', compact('pasien'));
    }

    public function update($id)
    {
        $pasien = Pasien::findOrFail($id);

        $pasien->update([
            'nama' => request('nama'),
            'umur' => request('umur'),
            'alamat' => request('alamat'),
            'telepon' => request('telepon'),
            'nomor_wa' => request('nomor_wa'),
        ]);

        return redirect('/pasien/' . $id)->with('success', 'Data pasien berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);

        $pasien->delete();

        return redirect('/pasien')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}

