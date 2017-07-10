<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateParserCryptowatchTable extends Migration
{
    public function up()
    {
        Schema::create('ikas_parser_cryptowatch', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('exchange', 20);
            $table->string('currency_pair', 30);
            $table->string('price');
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS ikas_parser_cryptowatch CASCADE');
    }
}
