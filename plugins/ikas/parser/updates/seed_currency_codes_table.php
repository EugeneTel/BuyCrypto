<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Updates\Seeder;

class SeedCurrencyCodesTable extends Seeder
{
    public function run()
    {
        DB::table('ikas_parser_currency_codes')->delete();
        DB::table('ikas_parser_currency_codes')->insert([
            [
                'name' => '',
                'code' => ''
            ],
        ]);
    }
}

