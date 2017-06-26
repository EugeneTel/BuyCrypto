<?php namespace Laradev\Crypto\Updates;

use October\Rain\Database\Updates\Seeder;
use Laradev\Crypto\Models\Currency;

class SeedCurrenciesTable extends Seeder
{
    public function run()
    {
        $fiatList = [
            'WMZ' => 'USD',
            'WMR' => 'RUB',
            'WME' => 'EUR',
            'WMU' => 'UAH',
            'OKPay USD' => 'USD',
            'OKPay RUB' => 'RUB',
            'OKPay EUR' => 'EUR',
            'Приват 24 USD' => 'USD',
            'Приват 24 UAH' => 'UAH',
            'Capitalist USD' => 'USD',
            'Яндекс.Деньги' => 'RUB',
            'Payeer USD' => 'USD',
            'Payeer RUB' => 'RUB',
            'Payeer EUR' => 'EUR',

//            'Paymer USD' => 'USD',
//            'Paymer RUB' => 'RUB',
//            'Paymer UAH' => 'UAH',
//            'QIWI USD' => 'USD',
//            'QIWI RUB' => 'RUB',
//            'QIWI EUR' => 'EUR',
//            'Perfect Money USD' => 'USD',
//            'Perfect Money EUR' => 'EUR',
//            'Perfect Money BTC' => 'BTC',
//            'Skrill USD' => 'USD',
//            'Skrill EUR' => 'EUR',
//            'Payza USD' => 'USD',
//            'Payza EUR' => 'EUR',
//            'Paxum USD' => 'USD',
//            'Paxum EUR' => 'EUR',
//            'MoneyPolo USD' => 'USD',
//            'MoneyPolo EUR' => 'EUR',
            ];

        $cryptoList = [
            'Bitcoin' => 'BTC',
            'Litecoin' => 'LTC',
            'Ethereum' => 'ETH',
            'Ethereum Classic' => 'ETC',
            'Dash' => 'DASH',

//            'Ripple' => 'XRP',
//            'Monero' => 'XMR',
//            'Dogecoin' => 'DOGE',
//            'Namecoin' => 'NMC',
//            'Peercoin' => 'PPC',
//            'Zcash' => 'ZEC',
//            'Tether' => 'USDT',
        ];

        $exchangerList = [
            'BTC-e USD' => 'USD',
            'BTC-e RUB' => 'RUB',
            'BTC-e EUR' => 'EUR',
            'BTC-e BTC' => 'BTC',
            'BTC-e ETH' => 'ETH',
            'BTC-e LTC' => 'LTC',
            'Exmo USD' => 'USD',
            'Exmo RUB' => 'RUB',
            'Exmo EUR' => 'EUR',
            'Exmo UAH' => 'UAH',
            'Exmo BTC' => 'BTC',
            'Exmo ETH' => 'ETH',
            'Exmo DASH' => 'DASH',
            'Exmo LTC' => 'LTC',
            'Poloniex BTC' => 'BTC',
            'Poloniex ETH' => 'ETH',
            'Poloniex ETC' => 'ETC',
            'Poloniex LTC' => 'LTC',
        ];

        foreach ($fiatList as $name => $code) {
            Currency::create([
                'name' => $name,
                'code' => $code,
                'type' => Currency::TYPE_FIAT,
                'active' => true,
            ]);
        }

        foreach ($cryptoList as $name => $code) {
            Currency::create([
                'name' => $name,
                'code' => $code,
                'type' => Currency::TYPE_CRYPTO,
                'active' => true,
            ]);
        }

        foreach ($exchangerList as $name => $code) {
            Currency::create([
                'name' => $name,
                'code' => $code,
                'type' => Currency::TYPE_TRADE,
                'active' => true,
            ]);
        }





        // don't used yet
        $other = [
            'WMB',
            'WMK',
            'WMG',
            'WMX',

            'QIWI KZT',

            'PM e-Voucher USD',
            'PayPal USD',
            'PayPal RUB',
            'PayPal EUR',
            'PayPal GBP',


            'Cryptocheck',
            'eCoin',
            'Криптобиржи USD',
            'Криптобиржи EUR',
            'Advanced Cash USD',
            'Advanced Cash RUB',
            'Advanced Cash EUR',
            'Advanced Cash UAH',

            'W1 USD',
            'W1 UAH',
            'Idram',

            'ePayments',
            'Epese',

            'Neteller USD',
            'Neteller EUR',
            'PaySera',
            'PaySafeCard',
            'SolidTrust Pay',
            'NixMoney USD',
            'NixMoney EUR',
            'Epay',
            'Alipay',
            'C-Gold',
            'LiqPay',
            'E-kzt',
            'Z-Payment',
            'Сбербанк',
            'Альфа-Банк',
            'Альфа cash-in USD',
            'Альфа cash-in RUB',
            'Тинькофф',
            'ВТБ24',
            'Русский Стандарт',
            'Авангард',
            'Промсвязьбанк',
            'Открытие',
            'Кукуруза',
            'Райффайзен',
            'РНКБ',

            'Райффайзен UAH',
            'Ощадбанк',
            'ПУМБ',
            'Беларусбанк',
            'Казкоммерцбанк',
            'HalykBank',
            'Сбербанк KZT',
            'ForteBank',
            'Банк Астаны',
            'UnionPay',
            'Visa/MasterCard USD',
            'Visa/MasterCard RUB',
            'Visa/MasterCard EUR',
            'Visa/MasterCard UAH',
            'Visa/MasterCard BYN',
            'Visa/MasterCard KZT',
            'Любой банк USD',
            'Любой банк RUB',
            'Любой банк EUR',
            'Любой банк UAH',
            'Любой банк KZT',
            'Любой банк GBP',
            'Любой банк CNY',
            'Любой банк THB',
            'Western Union USD',
            'Western Union EUR',
            'MoneyGram USD',
            'MoneyGram EUR',
            'Contact USD',
            'Contact RUB',
            'Золотая Корона USD',
            'Золотая Корона RUB',
            'Юнистрим',
            'Ria USD',
            'Ria EUR',
            'Наличные USD',
            'Наличные RUB',
            'Наличные EUR',
            'Наличные UAH',
            'Наличные KZT'
        ];
    }
}

