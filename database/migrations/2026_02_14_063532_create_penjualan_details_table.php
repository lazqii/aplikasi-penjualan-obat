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
        Schema::create('penjualan_details', function (Blueprint $table) {
            $table->string('Nota', 20);
            $table->string('KdObat', 10);
            $table->integer('Jumlah');

            $table->foreign('Nota')->references('Nota')->on('penjualans')->onDelete('cascade');
            $table->foreign('KdObat')->references('KdObat')->on('obats');
            $table->primary(['Nota', 'KdObat']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_details');
    }
};
