<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $search = request('search');

        $dokter = Dokter::when($search,function($q) use ($search){

            $q->where('nama_dokter','like',"%$search%")
            ->orWhere('spesialis','like',"%$search%");

        })
        ->orderBy('nama_dokter')
        ->get();

        return view('dokter.index',compact(
            'dokter',
            'search'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required|max:100',
            'spesialis'   => 'nullable|max:100',
            'nomor_sip'   => 'nullable|max:100',
            'telepon'     => 'nullable|max:20',
            'status'      => 'required'
        ]);

        Dokter::create([

            'nama_dokter' => $request->nama_dokter,

            'spesialis' => $request->spesialis,

            'nomor_sip' => $request->nomor_sip,

            'telepon' => $request->telepon,

            'status' => $request->status

        ]);

        return redirect('/dokter')
                ->with('success','Data dokter berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);

        return view('dokter.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_dokter' => 'required|max:100',
        'spesialis' => 'nullable|max:100',
        'nomor_sip' => 'nullable|max:100',
        'telepon' => 'nullable|max:20',
        'status' => 'required'
    ]);

    $dokter = Dokter::findOrFail($id);

    $dokter->update([
        'nama_dokter' => $request->nama_dokter,
        'spesialis' => $request->spesialis,
        'nomor_sip' => $request->nomor_sip,
        'telepon' => $request->telepon,
        'status' => $request->status
    ]);

    return redirect('/dokter')
            ->with('success','Data dokter berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);

        if ($dokter->jadwal()->exists()) {
            return redirect()
                ->route('dokter.index')
                ->with('error', 'Dokter tidak dapat dihapus karena masih memiliki jadwal.');
        }

        $dokter->delete();

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Dokter berhasil dihapus.');
    }
}
