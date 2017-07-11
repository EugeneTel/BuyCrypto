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
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS ikas_parser_bestchange CASCADE');
    }
}
