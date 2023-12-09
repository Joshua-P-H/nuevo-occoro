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
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->id();
            $table->string('content_convocatoria');
            $table->foreignId('convocatoria_fecha_id')->constrained('convocatoria_fechas')->onDelete('cascade');

                $table->timestamps();
           // $table->foreign('convocatoria_fecha_id')->references('id')->on('convocatoria_fechas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocatorias');
    }
};
