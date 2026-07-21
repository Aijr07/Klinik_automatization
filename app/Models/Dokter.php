<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [

        'nama_dokter',

        'spesialis',

        'nomor_sip',

        'telepon',

        'status'

    ];

    public function jadwal()
    {
        return $this->hasMany(JadwalDokter::class);
    }
}