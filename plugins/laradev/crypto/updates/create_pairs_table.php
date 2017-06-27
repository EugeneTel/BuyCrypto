<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePairsTable extends Migration
{
    public function up()
    {
        Schema::create('laradev_crypto_pairs', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('currency_from')->unsigned();
            $table->integer('currency_to')->unsigned();
            $table->string('name')->unique()->index();
            $table->boolean('active');
            $table->timestamps();

            $table->unique(['currency_from', 'currency_to']);
            $table->foreign('currency_from')->references('id')->on('laradev_crypto_currencies')->onDelete('cascade');
            $table->foreign('currency_to')->references('id')->on('laradev_crypto_currencies')->onDelete('cascade');
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS laradev_crypto_pairs CASCADE');

//        Schema::dropIfExists('laradev_crypto_pairs');
    }
}
