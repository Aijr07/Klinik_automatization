<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    public $timestamps = false;

    protected $fillable = [
        'pasien_id',
        'nomor_antrian',
        'keluhan',
        'tanggal',
        'status',
        'jenis_pasien',
        'tujuan_rujukan',
        'alasan_rujukan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}