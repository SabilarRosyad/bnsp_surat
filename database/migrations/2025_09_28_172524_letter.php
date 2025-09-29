<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('letter', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->date('date');
            $table->string('file_path');
            $table->string('nomor_surat')->nullable();
            $table->string('kategori')->nullable();  
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('letter');
    }
};
