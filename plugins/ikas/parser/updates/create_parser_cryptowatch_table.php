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
            $table->string('provider_id', 20)->references('id')->on('ikas_parser_cryp_providers');
            $table->string('pair_id', 30)->references('id')->on('ikas_parser_cryp_pairs');
            $table->string('price');
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS ikas_parser_cryptowatch CASCADE');
    }
}
