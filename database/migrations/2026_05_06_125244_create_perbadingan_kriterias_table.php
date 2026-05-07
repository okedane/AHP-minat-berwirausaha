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
        //perbandingan_kriterias
        Schema::create('perbandingan_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id_1')->constrained('kriterias')->onDelete('cascade');
            $table->foreignId('kriteria_id_2')->constrained('kriterias')->onDelete('cascade');
            $table->decimal('nilai', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbadingan_kriterias');
    }
};
