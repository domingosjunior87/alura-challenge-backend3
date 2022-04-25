<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->string('banco_origem', 200);
            $table->string('agencia_origem', 10);
            $table->string('conta_origem', 20);
            $table->string('banco_destino', 200);
            $table->string('agencia_destino', 10);
            $table->string('conta_destino', 20);
            $table->float('valor', 12, 2);
            $table->dateTime('data_hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacoes');
    }
}
