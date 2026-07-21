<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_dokter', function (Blueprint $table) {

            $table->boolean('hari_ini')->default(true);

            $table->boolean('besok')->default(true);

            $table->boolean('h2')->default(true);

            $table->boolean('h3')->default(true);

            $table->boolean('h4')->default(true);

            $table->boolean('h5')->default(true);

            $table->boolean('h6')->default(true);

        });
    }

    public function down(): void
    {
        Schema::table('jadwal_dokter', function (Blueprint $table) {

            $table->dropColumn([
                'hari_ini',
                'besok',
                'h2',
                'h3',
                'h4',
                'h5',
                'h6'
            ]);

        });
    }
};