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
        Schema::create('supliers', function (Blueprint $table) {
            $table->string('KdSuplier', 10)->primary();
            $table->string('NmSuplier', 50);
            $table->string('Alamat', 100);
            $table->string('Kota', 30);
            $table->string('NoTelp', 15);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supliers');
    }
};
