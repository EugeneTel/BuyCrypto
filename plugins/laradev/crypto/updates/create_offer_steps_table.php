<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOfferStepsTable extends Migration
{
    public function up()
    {
        Schema::create('laradev_crypto_offer_steps', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->integer('step_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->integer('pair_provider_id')->unsigned();
            $table->double('price')->unsigned();
            $table->integer('time_avg')->unsigned();
            $table->tinyInteger('order')->nullable();

            $table->foreign('offer_id')->references('id')->on('laradev_crypto_offers')->onDelete('cascade');
            $table->foreign('step_id')->references('id')->on('laradev_crypto_steps')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('laradev_crypto_providers')->onDelete('cascade');
            $table->foreign('pair_provider_id')->references('id')->on('laradev_crypto_pair_providers')->onDelete('cascade');

        });
    }

    public function down()
    {
//        Schema::dropIfExists('laradev_crypto_offer_steps');

        DB::statement('DROP TABLE IF EXISTS laradev_crypto_offer_steps CASCADE');
    }

}
