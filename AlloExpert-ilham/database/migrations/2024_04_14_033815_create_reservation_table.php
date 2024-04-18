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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('service');
            $table->date('date_reservation');
            $table->time('heure')->nullable(); // Add heure field
            $table->string('partenaire_nom')->nullable(); // Add partenaire_nom field
            $table->string('partenaire_prenom')->nullable(); // Add partenaire_prenom field
            $table->integer('id_clt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
