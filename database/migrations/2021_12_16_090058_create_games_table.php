<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('capa', 200)->default('');
            $table->string('titulo', 100);
            $table->string('ano_publicacao', 4)->default(strval(date("Y")));
            $table->enum('estilo', ['acao', 'fps', 'rpg', 'aventura', 'corrida', 'luta', 'esportes', 'battle-royale', 'estrategia']);
            $table->string('desenvolvedora', 50);
            $table->float('avaliacao', 3, 2)->default(0);
            $table->bigInteger('times_rated')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
