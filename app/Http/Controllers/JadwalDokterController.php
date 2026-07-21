<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;

class JadwalDokterController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalDokter::with('dokter')
                    ->orderBy('hari')
                    ->orderBy('jam_mulai');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('hari', 'like', "%{$search}%")
                  ->orWhere('nama_dokter', 'like', "%{$search}%")
                  ->orWhereHas('dokter', function ($dokter) use ($search) {

                        $dokter->where('nama_dokter', 'like', "%{$search}%");

                  });

            });

        }

        $jadwal = $query->get();

        return view('jadwal.index', compact('jadwal'));
    }


    public function create()
    {
        $dokter = Dokter::where('status', 1)
                    ->orderBy('nama_dokter')
                    ->get();

        return view('jadwal.create', compact('dokter'));
    }
        public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokter,id',

            'hari' => [
                'required',
                Rule::unique('jadwal_dokter')->where(function ($query) use ($request) {

                    return $query->where('dokter_id', $request->dokter_id);

                }),
            ],

            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
            'keterangan'  => 'nullable|string|max:255',
        ], [

            'hari.unique' => 'Dokter tersebut sudah memiliki jadwal pada hari yang dipilih.'

        ]);


        $dokter = Dokter::findOrFail($request->dokter_id);


        JadwalDokter::create([

            'dokter_id'   => $dokter->id,

            // disimpan sementara agar kompatibel dengan tampilan lama
            'nama_dokter' => $dokter->nama_dokter,

            'hari'        => $request->hari,

            'jam_mulai'   => $request->jam_mulai,

            'jam_selesai' => $request->jam_selesai,

            'keterangan'  => $request->keterangan,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate ulang jadwal pendaftaran
        |--------------------------------------------------------------------------
        */

        Artisan::call('jadwal:generate');


        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal praktik berhasil ditambahkan.');
    }
        public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $dokter = Dokter::where('status', 1)
                    ->orderBy('nama_dokter')
                    ->get();

        return view('jadwal.edit', compact('jadwal', 'dokter'));
    }


    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $request->validate([
            'dokter_id' => 'required|exists:dokter,id',

            'hari' => [
                'required',
                Rule::unique('jadwal_dokter')
                    ->ignore($jadwal->id)
                    ->where(function ($query) use ($request) {

                        return $query->where('dokter_id', $request->dokter_id);

                    }),
            ],

            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
            'keterangan'  => 'nullable|string|max:255',

        ], [

            'hari.unique' => 'Dokter tersebut sudah memiliki jadwal pada hari yang dipilih.'

        ]);


        $dokter = Dokter::findOrFail($request->dokter_id);


        $jadwal->update([

            'dokter_id'   => $dokter->id,

            // sementara tetap disimpan
            'nama_dokter' => $dokter->nama_dokter,

            'hari'        => $request->hari,

            'jam_mulai'   => $request->jam_mulai,

            'jam_selesai' => $request->jam_selesai,

            'keterangan'  => $request->keterangan,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate ulang jadwal pendaftaran
        |--------------------------------------------------------------------------
        */

        Artisan::call('jadwal:generate');


        return redirect()
                ->route('jadwal.index')
                ->with('success', 'Jadwal praktik berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $jadwal->delete();

        /*
        |--------------------------------------------------------------------------
        | Generate ulang jadwal pendaftaran
        |--------------------------------------------------------------------------
        */

        Artisan::call('jadwal:generate');

        return redirect()
                ->route('jadwal.index')
                ->with('success', 'Jadwal praktik berhasil dihapus.');
    }

}