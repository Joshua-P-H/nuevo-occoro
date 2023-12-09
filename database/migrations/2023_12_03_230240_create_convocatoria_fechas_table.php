<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Convocatoria;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('convocatoria_fechas', function (Blueprint $table) {
            $table->id();
            $table->string('title_convocatoria');
            $table->boolean('activo')->default(true);
            $table->date('fecha_limite');
            $table->date('fecha_fin');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocatoria_fechas');
    }
};
