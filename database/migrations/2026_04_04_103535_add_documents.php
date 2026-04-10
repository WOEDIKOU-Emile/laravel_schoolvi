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
        Schema::create('documents', function (Blueprint $table) {
            $table->id('idDocument');
            $table->foreignId('idUtilisateur')->constrained('users', 'idUtilisateur')->onDelete('cascade');
            $table->foreignId('idMatiere')->constrained('matieres', 'idMatiere');
            $table->foreignId('idNiveau')->constrained('niveaux', 'idNiveau');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('fichier')->nullable();
            $table->boolean('termine')->default(false); // pour le todo
            $table->timestamp('dateUpload')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
