<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlerResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler_results', function (Blueprint $table) {
            $table->id();
            $table->string('regex_match')->unique(); // Para evitar duplicatas
            $table->string('found_at')->nullable(); // URL do post onde a chave foi encontrada
            $table->timestamps(); // Para manter controle de quando o resultado foi criado e atualizado
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crawler_results');
    }
}
