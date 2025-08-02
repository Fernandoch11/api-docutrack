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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->date('emitido');
            $table->string('status');
            $table->string('file_route');
            $table->timestamps();
        });
        
        
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
