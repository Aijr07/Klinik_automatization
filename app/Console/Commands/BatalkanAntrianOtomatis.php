<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BatalkanAntrianOtomatis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'antrian:batal-otomatis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membatalkan seluruh antrian yang sudah melewati tanggal pelayanan.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Models\Pendaftaran::whereDate('tanggal', '<', now()->toDateString())
            ->whereIn('status', [
                'menunggu',
                'dipanggil'
            ])
            ->update([
                'status' => 'batal'
            ]);

        $this->info('Status antrian lama berhasil diubah menjadi batal.');

        return self::SUCCESS;
    }
}
