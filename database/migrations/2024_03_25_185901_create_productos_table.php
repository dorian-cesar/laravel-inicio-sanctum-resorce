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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->require();
            $table->integer('cantidad')->require();
            $table->float('price',4,2)->require();
            $table->unsignedBigInteger('categoria_id')->nullable();
            

          
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');


          


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
