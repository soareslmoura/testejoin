<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_produto_id');
            $table->string('nome',200);
            $table->date('data_cadastro');
            $table->float('valor',8,2);
            $table->timestamps();

            //FK

            $table->foreign('categoria_produto_id')->references('id')->on('categoria_produtos');

            //Unique para o caso de relacionamento 1 -> 1
            //$table->unique('categoria_produto_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {

            $table->dropForeign('produtos_categoria_produto_id_foreign');
            $table->dropColumn('categoria_produto_id');
        });
        Schema::dropIfExists('produtos');
    }
}
