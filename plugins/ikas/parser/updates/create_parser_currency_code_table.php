<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateParserCurrencyCodeTable extends Migration
{
    public function up()
    {
        Schema::create('ikas_parser_currency_code', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('code', 20)->unique();
            $table->integer('crypto_currencies_id')->references('id')->on('laradev_crypto_currencies')->nullable();
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS ikas_parser_currency_code CASCADE');
//        Schema::dropIfExists('laradev_crypto_currencies');
    }
}
