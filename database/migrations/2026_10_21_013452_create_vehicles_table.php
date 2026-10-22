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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('id'); // Colocando o ID.
            $table->string('marca');
            $table->string('modelo');
            $table->integer('ano');
            $table->string('placa')->unique();
            $table->decimal('preco', 10, 2);
            $table->string('cambio');
            $table->text('observacao')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
