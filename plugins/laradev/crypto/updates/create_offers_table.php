<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOffersTable extends Migration
{
    public function up()
    {
        Schema::create('laradev_crypto_offers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('hash')->unique()->index();
            $table->integer('way_id')->unsigned();
            $table->double('total_price');
            $table->integer('total_time')->nullable();
            $table->boolean('active');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('way_id')->references('id')->on('laradev_crypto_ways')->onDelete('cascade');
        });
    }

    public function down()
    {
//        Schema::dropIfExists('laradev_crypto_offers');

        DB::statement('DROP TABLE IF EXISTS laradev_crypto_offers CASCADE');
    }

}
