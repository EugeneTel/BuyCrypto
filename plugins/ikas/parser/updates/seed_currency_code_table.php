<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Updates\Seeder;

class SeedCurrencyCodeTable extends Seeder
{
    public function run()
    {
        DB::table('ikas_parser_currency_code')->delete();
        DB::table('ikas_parser_currency_code')->insert([
            [
                'name' => '',
                'code' => ''
            ],
        ]);
    }
}

