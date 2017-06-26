<?php namespace Laradev\Crypto\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('laradev_crypto_providers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->unique();
            $table->tinyInteger('type');
            $table->text('desc')->nullable();
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laradev_crypto_providers');
    }
}
