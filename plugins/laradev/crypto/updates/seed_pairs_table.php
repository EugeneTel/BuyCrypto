<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use Laradev\Crypto\Models\Currency;
use Laradev\Crypto\Models\Pair;
use Laradev\Crypto\Models\Provider;
use October\Rain\Database\Updates\Seeder;

class SeedPairsTable extends Seeder
{
    public function run()
    {

        $providerList = [

            // Приват 24
            'Приват 24' => [
                'Приват 24 USD' => [
                    'Приват 24 UAH' => [
                        'price' => '25.85',
                        'time_avg' => '1',
                    ],

                ],
                'Приват 24 UAH' => [
                    'Приват 24 USD' => [
                        'price' => 0.04,
                        'time_avg' => '1',
                    ]
                ],
            ],

            // Webmoney
            'Webmoney' => [
                'WMZ' => [
                    'WMU' => [
                        'price' => 25.5,
                        'time_avg' => '5',
                    ],
                    'WMR' => [
                        'price' => 61.3990,
                        'time_avg' => '5'
                    ],
                ],
                'WMU' => [
                    'WMZ' => [
                        'price' => 0.0384,
                        'time_avg' => '5',
                    ],
                    'WMR' => [
                        'price' => 2.3899,
                        'time_avg' => '5'
                    ],
                ],
                'WMR' => [
                    'WMZ' => [
                        'price' => 0.0163,
                        'time_avg' => '5',
                    ],
                    'WMU' => [
                        'price' => 2.3654,
                        'time_avg' => '5'
                    ],
                ],
            ],

            // OKPay
            'OKPay' => [

            ],

            // Capitalist
            'Capitalist' => [

            ],

            // BTC-e
            'BTC-e' => [
                'OKPay USD' => [
                    'BTC-e USD' => [
                        'price' => 0.97,
                        'time_avg' => 5,
                    ],
                ],
                'Яндекс.Деньги' => [
                    'BTC-e RUB' => [
                        'price' => 0.945,
                        'time_avg' => 3,
                    ]
                ],
                'OKPay RUB' => [
                    'BTC-e RUB' => [
                        'price' => 0.93,
                        'time_avg' => 5,
                    ]
                ],
                'Capitalist USD' => [
                    'BTC-e USD' => [
                        'price' => 0.95,
                        'time_avg' => 5,
                    ],
                ],
                'BTC-e USD' => [
                    'BTC-e BTC' => [
                        'price' => 2451.304,
                        'time_avg' => 1,
                    ],
                    'BTC-e ETH' => [
                        'price' => 248.5,
                        'time_avg' => 1,
                    ],
                    'BTC-e LTC' => [
                        'price' => 0.0280,
                        'time_avg' => 1,
                    ],
                ],
                'BTC-e BTC' => [
                    'Bitcoin' => [
                        'price' => 0.999,
                        'time_avg' => 2,
                    ],
                    'BTC-e ETH' => [
                        'price' => 9.95,
                        'time_avg' => 1,
                    ],
                    'BTC-e LTC' => [
                        'price' => 9.95,
                        'time_avg' => 1,
                    ],
                ],
                'BTC-e ETH' => [
                    'Ether' => [
                        'price' => 0.999,
                        'time_avg' => 2,
                    ],
                    'BTC-e BTC' => [
                        'price' => 0.10078,
                        'time_avg' => 1,
                    ],

                    'BTC-e LTC' => [
                        'price' => 6.58663,
                        'time_avg' => 1,
                    ],
                ],

            ],

            // Exmo
            'Exmo' => [
                'Capitalist USD' => [
                    'Exmo USD' => [
                        'price' => 1,
                        'time_avg' => 3,
                    ],
                ],
                'OKPay USD' => [
                    'Exmo USD' => [
                        'price' => 0.98,
                        'time_avg' => 3,
                    ],
                ],
                'Payeer USD' => [
                    'Exmo USD' => [
                        'price' => 0.97,
                        'time_avg' => 3,
                    ],
                ],
                'Яндекс.Деньги' => [
                    'Exmo RUB' => [
                        'price' => 0.95,
                        'time_avg' => 3,
                    ],
                ],
                'OKPay RUB' => [
                    'Exmo RUB' => [
                        'price' => 0.97,
                        'time_avg' => 3,
                    ],
                ],
                'Приват 24 UAH' =>[
                    'Exmo UAH' => [
                        'price' => 0.96,
                        'time_avg' => 3,
                    ],
                ],
                'Exmo USD' => [
                    'Exmo BTC' => [
                        'price' => 0.0004,
                        'time_avg' => 1,
                    ],
                    'Exmo ETH' => [
                        'price' => 0.0039999,
                        'time_avg' => 1,
                    ],
                    'Exmo RUB' => [
                        'price' => 60.59,
                        'time_avg' => 1,
                    ],
                ],
                'Exmo RUB' => [
                    'Exmo USD' => [
                        'price' => 0.01,
                        'time_avg' => 1,
                    ],
                    'Exmo ETH' => [
                        'price' => 0.00006551,
                        'time_avg' => 1,
                    ],
                    'Exmo LTC' => [
                        'price' => 0.00043177,
                        'time_avg' => 1,
                    ],
                    'Exmo BTC' => [
                        'price' => 0.00000654,
                        'time_avg' => 1,
                    ],
                ],
                'Exmo UAH' => [
                    'Exmo BTC' => [
                        'price' => 0.00001486,
                        'time_avg' => 1,
                    ],
                ],
                'Exmo BTC' => [
                    'Bitcoin' => [
                        'price' => 0.999,
                        'time_avg' => 2
                    ],
                    'Exmo ETH' => [
                        'price' => 9.77958669,
                        'time_avg' => 1,
                    ],
                    'Exmo LTC' => [
                        'price' => 66.00660066,
                        'time_avg' => 1,
                    ],
                ],
                'Exmo ETH' => [
                    'Ether' => [
                        'price' => 0.99,
                        'time_avg' => 2
                    ],
                    'Exmo BTC' => [
                        'price' => 0.10028155,
                        'time_avg' => 1,
                    ],
                    'Exmo LTC' => [
                        'price' => 6.60001008,
                        'time_avg' => 1,
                    ],
                ],
                'Exmo LTC' => [
                    'Litecoin' => [
                        'price' => 0.99,
                        'time_avg' => 2
                    ],
                    'Exmo BTC' => [
                        'price' => 0.01507798,
                        'time_avg' => 1,
                    ],
                    'Exmo ETH' => [
                        'price' => 0.14998631,
                        'time_avg' => 1,
                    ],
                ],

            ],

            // Poloniex
            'Poloniex' => [

            ],

            // NewLine
            'NewLine' => [
                'OKPay USD' => [
                    'Bitcoin' => [
                        'price' => 1,
                        'time_avg' => 5,
                    ],
                    'Ether' => [
                        'price' => 0.0037594,
                        'time_avg' => 5,
                    ],
                    'Litecoin' => [
                        'price' => 0.025,
                        'time_avg' => 5,
                    ],
                    'BTC-e USD' => [
                        'price' => 0.95,
                        'time_avg' => 5,

                    ],
                    'BTC-e RUB' => [
                        'price' => 55.7714,
                        'time_avg' => 5,

                    ],
                    'Exmo USD' => [
                        'price' => 0.94,
                        'time_avg' => 5,

                    ],
                    'Exmo RUB' => [
                        'price' => 55.413,
                        'time_avg' => 5,
                    ],
                    'Яндекс.Деньги' => [
                        'price' => 57.7121,
                        'time_avg' => 5,
                    ]
                ],
                'OKPay RUB' => [
                    'Bitcoin' => [
                        'price' => 0.00000595,
                        'time_avg' => 5,
                    ],
                    'Ether' => [
                        'price' => 0.000064,
                        'time_avg' => 5,
                    ],
                    'Litecoin' => [
                        'price' => 0.000387,
                        'time_avg' => 5,
                    ],
                    'BTC-e RUB' => [
                        'price' => 0.91,
                        'time_avg' => 5,
                    ],
                    'BTC-e USD' => [
                        'price' => 0.0144,
                        'time_avg' => 5,
                    ],
                    'Exmo RUB' => [
                        'price' => 0.92,
                        'time_avg' => 5,
                    ],
                    'Exmo USD' => [
                        'price' => 0.0144,
                        'time_avg' => 5,
                    ],
                    'Яндекс.Деньги' => [
                        'price' => 0.965,
                        'time_avg' => 5,
                    ]
                ],
                'WMZ' => [
                    'Яндекс.Деньги' => [
                        'price' => 59.6,
                        'time_avg' => 5,
                    ],
                    'Capitalist USD' => [
                        'price' => 0.935,
                        'time_avg' => 5,
                    ],
                ],
                'Exmo BTC' => [
                    'Bitcoin' => [
                        'price' => 0.995,
                        'time_avg' => 5
                    ],
                ]
            ],

            // obmen.cc
            'obmen.cc' => [
                'Приват 24 UAH' => [
                    'WMZ' => [
                        'price' => 0.038,
                        'time_avg' => 3,
                    ],
                    'WMU' => [
                        'price' => 0.985,
                        'time_avg' => 3,
                    ]
                ],
                'WMZ' => [
                    'Яндекс.Деньги' => [
                        'price' => 59.66,
                        'time_avg' => 5,
                    ],
                    'Capitalist USD' => [
                        'price' => 0.943,
                        'time_avg' => 5,
                    ],
                ],
                'Яндекс.Деньги' => [
                    'Capitalist USD' => [
                        'price' => 0.01577,
                        'time_avg' => 5,
                    ],
                    'WMZ' => [
                        'price' => 0.01603,
                        'time_avg' => 5,
                    ],
                    'Exmo RUB' => [
                        'price' => 0.94,
                        'time_avg' => 3,
                    ],
                ],
            ],

            // Обменник.ws
            'Обменник.ws' => [
                'Приват 24 UAH' => [
                    'WMZ' => [
                        'price' => 0.03782,
                        'time_avg' => 3,
                    ],
                    'WMU' => [
                        'price' => 0.98,
                        'time_avg' => 3,
                    ]
                ],
                'Яндекс.Деньги' => [
                    'Capitalist USD' => [
                        'price' => 0.0155,
                        'time_avg' => 5,
                    ],
                    'WMZ' => [
                        'price' => 0.015,
                        'time_avg' => 5,
                    ],
                    'Exmo RUB' => [
                        'price' => 0.945,
                        'time_avg' => 3,
                    ],
                ],
            ]

        ];

        $currencyObjectList = Currency::all();

        $currencyList = [];

        foreach ($currencyObjectList->toArray() as $currency) {
            $currencyList[$currency['name']] = $currency;
        }

        foreach ($providerList as $providerName => $providerExchange) {
            $provider = Provider::where('name', $providerName)->first();
            $provider->pairs()->detach();

            foreach ($providerExchange as $curFromName => $toList) {
                $curFrom = $currencyList[$curFromName];

                foreach ($toList as $curToName => $curToData) {
                    $curTo = $currencyList[$curToName];

                    $pairName = $curFromName . '/' . $curToName;

                    $pair = Pair::firstOrCreate(
                        ['name' => $pairName, 'currency_from' => $curFrom['id'], 'currency_to' => $curTo['id'], 'active' => true]);

                    $provider->pairs()->attach([
                        $pair->id => ['price' => $curToData['price'], 'time_avg' => $curToData['time_avg']]
                    ]);


                    echo $pairName . "\n";

                }
            }
        }

    }

    public function old()
    {

        $list = [
            'WMZ' => ['WMR', 'WME', 'WMU', 'OKPay USD', 'Приват 24 UAH', 'Capitalist USD', 'Яндекс.Деньги', 'Bitcoin'],
            'WMR' => ['WMZ', 'WMU', 'OKPay USD', 'OKPay RUB', 'Приват 24 UAH', 'Capitalist USD', 'Яндекс.Деньги'],
            'WMU' => ['WMZ', 'Приват 24 UAH'],
            'OKPay USD' => ['WMZ', 'OKPay RUB', 'OKPay EUR', 'Приват 24 UAH', 'Capitalist USD', 'Яндекс.Деньги', 'Payeer USD', 'Bitcoin', 'Ether', 'Litecoin', 'BTC-e USD', 'Exmo USD'],
            'OKPay RUB' => ['OKPay USD', 'WMZ', 'WMR', 'Приват 24 UAH', 'Яндекс.Деньги', 'BTC-e RUB', 'Exmo RUB'],
            'Приват 24 UAH' => ['Приват 24 USD', 'WMZ', 'WMR', 'OKPay USD', 'OKPay RUB', 'Яндекс.Деньги', 'Bitcoin', 'Ether'],
            'Приват 24 USD' => ['WMZ', 'Приват 24 UAH'],
            'Capitalist USD' => ['WMZ', 'WMR', 'Приват 24 UAH', 'Payeer USD', 'Payeer RUB', 'Payeer EUR', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR', 'Bitcoin', 'Ether', 'Litecoin'],
            'Яндекс.Деньги' => ['WMR', 'WMZ', 'Приват 24 UAH', 'Capitalist USD', 'OKPay USD', 'Payeer USD', 'Payeer RUB', 'Payeer EUR', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR', 'Bitcoin', 'Ether', 'Litecoin', 'Dash'],
            'Payeer USD' => ['WMR', 'WMZ', 'Яндекс.Деньги', 'Приват 24 UAH', 'Capitalist USD', 'OKPay USD', 'Payeer RUB', 'Payeer EUR', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR', 'Bitcoin', 'Ether', 'Litecoin', 'Dash'],
            'BTC-e USD' => ['BTC-e BTC', 'BTC-e ETH', 'BTC-e LTC'],
            'BTC-e RUB' => ['BTC-e USD'],
            'BTC-e EUR' => ['BTC-e USD', 'BTC-e LTC'],
            'BTC-e BTC' => ['Bitcoin', 'BTC-e ETH', 'BTC-e LTC', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR'],
            'BTC-e ETH' => ['Ether', 'BTC-e BTC', 'BTC-e LTC', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR'],
            'BTC-e LTC' => ['Litecoin', 'BTC-e BTC', 'BTC-e ETH', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR'],
            'Exmo USD' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo RUB' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo EUR' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo UAH' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo BTC' => ['Bitcoin', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo ETH' => ['Ether', 'Exmo BTC', 'Exmo DASH', 'Exmo LTC'],
            'Exmo DASH' => ['Dash', 'Exmo BTC', 'Exmo ETH', 'Exmo LTC'],
            'Exmo LTC' => ['Litecoin', 'Exmo BTC', 'Exmo ETH', 'Exmo DASH'],
            'Poloniex BTC' => ['Bitcoin', 'Poloniex ETH', 'Poloniex ETC', 'Poloniex LTC'],
            'Poloniex ETH' => ['Ether', 'Poloniex BTC', 'Poloniex ETC', 'Poloniex LTC'],
            'Poloniex ETC' => ['Ether Classic', 'Poloniex BTC', 'Poloniex ETH', 'Poloniex LTC'],
            'Poloniex LTC' => ['Litecoin', 'Poloniex BTC', 'Poloniex ETH', 'Poloniex ETC'],
        ];

        $currencyObjectList = Currency::all();

        $currencyList = [];

        foreach ($currencyObjectList->toArray() as $currency) {
            $currencyList[$currency['name']] = $currency;
        }

        DB::statement('TRUNCATE laradev_crypto_pairs CASCADE');


        foreach ($list as $cur1 => $curList) {
            $curArr1 = $currencyList[$cur1];

            foreach ($curList as $cur2) {
                $curArr2 = $currencyList[$cur2];

                $pairName = $curArr1['name'] . '/' . $curArr2['name'];

                $pair = new Pair;
                $pair->currency_from = $curArr1['id'];
                $pair->currency_to = $curArr2['id'];
                $pair->name = $pairName;
                $pair->active = true;
                $pair->save();
            }
        }
    }
}

