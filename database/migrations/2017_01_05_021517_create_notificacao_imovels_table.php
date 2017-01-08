<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacaoImovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_notificacao_imovel', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('estado', 2);
            $table->string('cidade', 50);
            $table->string('regiao', 100)->nullable();
            $table->string('tipo_negocio', 20);
            $table->string('tipo_imovel', 50);
            $table->double('valor_minimo')->nullable();
            $table->double('valor_maximo')->nullable();
            $table->unsignedInteger('area_minima')->nullable();
            $table->unsignedInteger('area_maxima')->nullable();
            $table->unsignedInteger('dormitorios')->nullable();
            $table->unsignedInteger('vagas')->nullable();
            $table->unsignedInteger('frequencia')->default(7);
            $table->string('tipo_cancelamento', 50)->nullable();
            $table->string('motivo_cancelamento', 2000)->nullable();
            $table->unsignedInteger('active')->default(1);
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
        Schema::dropIfExists('web_notificacao_imovel');
    }
}
