<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateStepsTable extends Migration
{
    public function up()
    {
        Schema::create('laradev_crypto_steps', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('way_id')->unsigned();
            $table->integer('pair_id')->unsigned();
            $table->tinyInteger('order')->nullable();

            $table->foreign('way_id')->references('id')->on('laradev_crypto_ways')->onDelete('cascade');
            $table->foreign('pair_id')->references('id')->on('laradev_crypto_pairs')->onDelete('cascade');
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS laradev_crypto_steps CASCADE');
//        Schema::dropIfExists('laradev_crypto_steps');
    }
}
