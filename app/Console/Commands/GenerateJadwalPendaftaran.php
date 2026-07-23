public function handle()
{
    $this->info('Generate Jadwal Pendaftaran...');

    $jadwalDokter = DB::table('jadwal_dokter')->get();

    $hariIni = Carbon::today('Asia/Makassar');

    for ($i = 0; $i <= 6; $i++) {

        $tanggal = $hariIni->copy()->addDays($i);

        $hari = strtolower(
            $tanggal
                ->locale('id')
                ->translatedFormat('l')
        );

        // Ambil SEMUA dokter yang praktik pada hari tersebut
        $jadwalHariIni = $jadwalDokter->filter(function ($item) use ($hari) {
            return strtolower($item->hari) == $hari;
        });

        // Jika tidak ada dokter
        if ($jadwalHariIni->isEmpty()) {

            DB::table('jadwal_pendaftaran')->updateOrInsert(

                [
                    'tanggal' => $tanggal->toDateString(),
                    'jadwal_dokter_id' => null
                ],

                [
                    'status_pendaftaran' => 'tutup',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]

            );

            continue;
        }

        // Simpan SATU BARIS UNTUK SETIAP DOKTER
        foreach ($jadwalHariIni as $jadwal) {

            DB::table('jadwal_pendaftaran')->updateOrInsert(

                [
                    'tanggal' => $tanggal->toDateString(),
                    'jadwal_dokter_id' => $jadwal->id
                ],

                [
                    'status_pendaftaran' => 'buka',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]

            );

        }

        $this->line(
            $tanggal->toDateString()
            ." | "
            .$hari
            ." | "
            .$jadwalHariIni->count()
            ." dokter"
        );
    }

    $this->info('Selesai.');

    return Command::SUCCESS;
}