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
        Schema::create('obats', function (Blueprint $table) {
            $table->string('KdObat', 10)->primary();
            $table->string('NmObat', 50);
            $table->string('Jenis', 50);
            $table->string('Satuan', 50);
            $table->integer('HargaBeli');
            $table->integer('HargaJual');
            $table->integer('Stok');
            $table->string('KdSuplier', 10);

            $table->foreign('KdSuplier')->references('KdSuplier')->on('supliers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
