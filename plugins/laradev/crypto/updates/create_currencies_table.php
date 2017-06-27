<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('laradev_crypto_currencies', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('code');
            $table->tinyInteger('type');
            //$table->integer('provider_id')->unsigned();
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS laradev_crypto_currencies CASCADE');
//        Schema::dropIfExists('laradev_crypto_currencies');
    }
}
