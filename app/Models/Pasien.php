<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'nrm',
        'nama',
        'umur',
        'alamat',
        'telepon',
        'nomor_wa',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'pasien_id');
    }

    
}