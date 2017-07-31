<?php namespace Ikas\Parser\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCrypPairsTable extends Migration
{
    public function up()
    {
        Schema::create('ikas_parser_cryp_pairs', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id')->unique();
            $table->foreign('from_id')->references('id')->on('ikas_parser_cryp_currencies');
            $table->foreign('to_id')->references('id')->on('ikas_parser_cryp_currencies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ikas_parser_cryp_pairs');
    }
}
