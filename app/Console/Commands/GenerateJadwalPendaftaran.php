<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateJadwalPendaftaran extends Command
{
    /**
     * Nama command
     */
    protected $signature = 'jadwal:generate';

    /**
     * Deskripsi command
     */
    protected $description = 'Generate jadwal pendaftaran berdasarkan jadwal dokter';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generate Jadwal Pendaftaran...');

        $jadwalDokter = DB::table('jadwal_dokter')
            ->pluck('hari')
            ->unique()
            ->toArray();

        $hariIni = Carbon::today('Asia/Makassar');

        for ($i = 0; $i <= 6; $i++) {

            $tanggal = $hariIni->copy()->addDays($i);

            $hari = $tanggal
                        ->locale('id')
                        ->translatedFormat('l');

            $status = in_array($hari, $jadwalDokter)
                        ? 'buka'
                        : 'tutup';

            DB::table('jadwal_pendaftaran')->updateOrInsert(

                [
                    'tanggal' => $tanggal->toDateString()
                ],

                [
                    'status_pendaftaran' => $status,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]

            );

            $this->line(

                $tanggal->toDateString()

                ." | "

                .$hari

                ." | "

                .$status

            );

        }

        $this->info('Selesai.');

        return Command::SUCCESS;
    }
}