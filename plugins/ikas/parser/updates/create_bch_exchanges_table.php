<?php namespace Ikas\Parser\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBchExchangesTable extends Migration
{
    public function up()
    {
        Schema::create('ikas_parser_bch_exchanges', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unique();
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ikas_parser_bch_exchanges');
    }
}
