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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('idMessage');
            $table->foreignId('idUtilisateur')->constrained('users', 'idUtilisateur');
            $table->foreignId('idAdmin')->nullable()->constrained('users', 'idUtilisateur');
            $table->text('contenu');
            $table->timestamp('dateEnvoi')->useCurrent();
            $table->enum('statut', ['lu', 'non_lu'])->default('non_lu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
