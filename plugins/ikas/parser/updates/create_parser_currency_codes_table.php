<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateParserCurrencyCodesTable extends Migration
{
    public function up()
    {
        Schema::create('ikas_parser_currency_codes', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('buy_currency_id')->unique();
            $table->string('out_id');
            $table->string('resource');
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS ikas_parser_currency_codes CASCADE');
//        Schema::dropIfExists('laradev_crypto_currencies');
    }
}
