<?php namespace Laradev\Crypto\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Laradev\Crypto\Models\Currency;
use Laradev\Crypto\Models\Pair;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateWay extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'crypto:generateway';

    /**
     * @var string The console command description.
     */
    protected $description = 'Generate ways';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $this->output->writeln('Hello world!');

        $list = [
            'WMZ' => ['WMR', 'WME', 'WMU', 'OKPay USD', 'Приват 24 UAH', 'Capitalist USD', 'Яндекс.Деньги', 'Bitcoin'],
            'WMR' => ['WMZ', 'WMU', 'OKPay USD', 'OKPay RUB', 'Приват 24 UAH', 'Capitalist USD', 'Яндекс.Деньги'],
            'WMU' => ['WMZ', 'Приват 24 UAH'],
            'OKPay USD' => ['WMZ', 'OKPay RUB', 'OKPay EUR', 'Приват 24 UAH', 'Capitalist USD', 'Яндекс.Деньги', 'Payeer USD', 'Bitcoin', 'Ethereum', 'Litecoin', 'BTC-e USD', 'Exmo USD'],
            'OKPay RUB' => ['OKPay USD', 'WMZ', 'WMR', 'Приват 24 UAH', 'Яндекс.Деньги', 'BTC-e RUB', 'Exmo RUB'],
            'Приват 24 UAH' => ['Приват 24 USD', 'WMZ', 'WMR', 'OKPay USD', 'OKPay RUB', 'Яндекс.Деньги', 'Bitcoin', 'Ethereum'],
            'Приват 24 USD' => ['WMZ', 'Приват 24 UAH'],
            'Capitalist USD' => ['WMZ', 'WMR', 'Приват 24 UAH', 'Payeer USD', 'Payeer RUB', 'Payeer EUR', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR', 'Bitcoin', 'Ethereum', 'Litecoin'],
            'Яндекс.Деньги' => ['WMR', 'WMZ', 'Приват 24 UAH', 'Capitalist USD', 'OKPay USD', 'Payeer USD', 'Payeer RUB', 'Payeer EUR', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR', 'Bitcoin', 'Ethereum', 'Litecoin', 'Dash'],
            'Payeer USD' => ['WMR', 'WMZ', 'Яндекс.Деньги', 'Приват 24 UAH', 'Capitalist USD', 'OKPay USD', 'Payeer RUB', 'Payeer EUR', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR', 'Bitcoin', 'Ethereum', 'Litecoin', 'Dash'],
            'BTC-e USD' => ['BTC-e BTC', 'BTC-e ETH', 'BTC-e LTC'],
            'BTC-e RUB' => ['BTC-e BTC', 'BTC-e ETH', 'BTC-e LTC'],
            'BTC-e EUR' => ['BTC-e BTC', 'BTC-e ETH', 'BTC-e LTC'],
            'BTC-e BTC' => ['Bitcoin', 'BTC-e ETH', 'BTC-e LTC', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR'],
            'BTC-e ETH' => ['Ethereum', 'BTC-e BTC', 'BTC-e LTC', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR'],
            'BTC-e LTC' => ['Litecoin', 'BTC-e BTC', 'BTC-e ETH', 'BTC-e USD', 'BTC-e RUB', 'BTC-e EUR'],
            'Exmo USD' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo RUB' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo EUR' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo UAH' => ['Exmo BTC', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo BTC' => ['Bitcoin', 'Exmo ETH', 'Exmo DASH', 'Exmo LTC'],
            'Exmo ETH' => ['Ethereum', 'Exmo BTC', 'Exmo DASH', 'Exmo LTC'],
            'Exmo DASH' => ['Dash', 'Exmo BTC', 'Exmo ETH', 'Exmo LTC'],
            'Exmo LTC' => ['Litecoin', 'Exmo BTC', 'Exmo ETH', 'Exmo DASH'],
            'Poloniex BTC' => ['Bitcoin', 'Poloniex ETH', 'Poloniex ETC', 'Poloniex LTC'],
            'Poloniex ETH' => ['Ethereum', 'Poloniex BTC', 'Poloniex ETC', 'Poloniex LTC'],
            'Poloniex ETC' => ['Ethereum Classic', 'Poloniex BTC', 'Poloniex ETH', 'Poloniex LTC'],
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
                'Capitalist USD'

            ],

        ];


    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
