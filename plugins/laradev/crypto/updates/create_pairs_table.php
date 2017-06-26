<?php namespace Laradev\Crypto\Updates;

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
            $table->string('name')->unique();
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('currency_from')->references('id')->on('laradev_crypto_currencies')->onDelete('cascade');
            $table->foreign('currency_to')->references('id')->on('laradev_crypto_currencies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('laradev_crypto_pairs');
    }
}
