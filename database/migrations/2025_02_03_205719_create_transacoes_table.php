<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero_conta');
            $table->enum('forma_pagamento', ['P', 'C', 'D']);
            $table->decimal('valor', 10, 2);
            $table->decimal('taxa_percentual', 5, 2);
            $table->decimal('valor_taxa', 10, 2);
            $table->timestamps();

            $table->foreign('numero_conta')->references('numero_conta')->on('contas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
