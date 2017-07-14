<?php namespace Ikas\Parser\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBCHCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('ikas_parser_bch_currencies', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unique();
            $table->integer('x1');
            $table->string('name', 30);
            $table->string('code', 30);
            $table->integer('bch_currency_codes_id')->references('id')->on('ikas_parser_bch_currency_codes')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ikas_parser_bch_currencies');
    }
}
