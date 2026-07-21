<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
        Schema::create('dokter', function (Blueprint $table) {

            $table->id();

            $table->string('nama_dokter');

            $table->string('spesialis')->nullable();

            $table->string('nomor_sip')->nullable();

            $table->string('telepon')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
