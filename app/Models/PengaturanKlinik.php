<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanKlinik extends Model
{
    protected $table = 'pengaturan_klinik';

    protected $fillable = [
        'nama_klinik',
        'alamat',
        'telepon',
        'kuota_harian',
        'jam_operasional',
        'status_pendaftaran',
        'alasan_tutup',
    ];
}