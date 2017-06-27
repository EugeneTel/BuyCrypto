<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
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
            $table->string('name');
            $table->tinyInteger('type');
            $table->text('desc')->nullable();
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS laradev_crypto_providers CASCADE');
//        Schema::dropIfExists('laradev_crypto_providers');
    }
}
