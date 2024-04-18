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
        Schema::create('intervention', function (Blueprint $table) {
            $table->id();
            $table->float('prix');
            $table->string('type_intervention');
            $table->date('date_depart');
            $table->date('date_arrivee');
            $table->integer('duree');
            $table->integer('id_par');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervention');
    }
};
