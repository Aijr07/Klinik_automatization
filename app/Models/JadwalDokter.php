<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';

    public $timestamps = false;

    protected $fillable = [
        'dokter_id',
        'nama_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}