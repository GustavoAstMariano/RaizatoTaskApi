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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Coluna para o título da tarefa
            $table->text('description')->nullable(); // Coluna para a descrição da tarefa
            $table->boolean('completed')->default(false); // Coluna para indicar se a tarefa foi concluída
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // Data da última alteração
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
