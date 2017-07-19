<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePairProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('laradev_crypto_pair_providers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pair_id')->unsigned()->index();
            $table->integer('provider_id')->unsigned();
            $table->double('price');
            $table->string('time_min')->nullable();
            $table->string('time_max')->nullable();
            $table->string('time_avg')->nullable();
            $table->json('note')->nullable();
            $table->dateTime('price_changed_at')->nullable();
            $table->timestamps();

            $table->foreign('pair_id')->references('id')->on('laradev_crypto_pairs')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('laradev_crypto_providers')->onDelete('cascade');
        });
    }

    public function down()
    {
//        Schema::dropIfExists('laradev_crypto_pair_providers');

        DB::statement('DROP TABLE IF EXISTS laradev_crypto_pair_providers CASCADE');
    }
}
