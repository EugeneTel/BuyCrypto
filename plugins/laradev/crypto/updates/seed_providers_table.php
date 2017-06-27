<?php namespace Laradev\Crypto\Updates;

use Laradev\Crypto\Models\Provider;
use October\Rain\Database\Updates\Seeder;

class SeedProvidersTable extends Seeder
{
    public function run()
    {
        \DB::table('laradev_crypto_providers')->insert([
            [
                'id' => 1,
                'name' => 'Приват 24',
                'type' => Provider::TYPE_PAYMENT,
                'active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Webmoney',
                'type' => Provider::TYPE_PAYMENT,
                'active' => true,
            ],
            [
                'id' => 3,
                'name' => 'OKPay',
                'type' => Provider::TYPE_PAYMENT,
                'active' => true,
            ],
            [
                'id' => 4,
                'name' => 'Capitalist',
                'type' => Provider::TYPE_PAYMENT,
                'active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Яндекс.Деньги',
                'type' => Provider::TYPE_PAYMENT,
                'active' => true,
            ],
            [
                'id' => 6,
                'name' => 'Payeer',
                'type' => Provider::TYPE_PAYMENT,
                'active' => true,
            ],

            [
                'id' => 7,
                'name' => 'BTC-e',
                'type' => Provider::TYPE_TRADE,
                'active' => true,
            ],
            [
                'id' => 8,
                'name' => 'Exmo',
                'type' => Provider::TYPE_TRADE,
                'active' => true,
            ],
            [
                'id' => 9,
                'name' => 'Poloniex',
                'type' => Provider::TYPE_TRADE,
                'active' => true,
            ],


            [
                'id' => 10,
                'name' => 'NewLine',
                'type' => Provider::TYPE_EXCHANGE,
                'active' => true,
            ],
            [
                'id' => 11,
                'name' => 'obmen.cc',
                'type' => Provider::TYPE_EXCHANGE,
                'active' => true,
            ],
            [
                'id' => 12,
                'name' => 'Обменник.ws',
                'type' => Provider::TYPE_EXCHANGE,
                'active' => true,
            ],
            [
                'id' => 13,
                'name' => 'BetaTransfer',
                'type' => Provider::TYPE_EXCHANGE,
                'active' => true,
            ],
        ]);
    }
}

