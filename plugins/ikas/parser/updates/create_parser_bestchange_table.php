<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateParserBestchangeTable extends Migration
{
    public function up()
    {
        Schema::create('ikas_parser_bestchange', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('from')->references('id')->on('ikas_parser_bch_currency')->nullable();
            $table->integer('to')->references('id')->on('ikas_parser_bch_currency')->nullable();
            $table->integer('bch_exchanges_id')->references('id')->on('ikas_parser_bch_exchanges')->nullable();
            $table->double('amount');
            $table->double('from_rate');
            $table->double('to_rate');
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS ikas_parser_bestchange CASCADE');
    }
}
