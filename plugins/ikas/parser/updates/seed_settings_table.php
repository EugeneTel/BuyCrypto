<?php namespace Laradev\Crypto\Updates;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Updates\Seeder;

class SeedCurrencyCodeTable extends Seeder
{
    public function run()
    {
        DB::table('ikas_parser_settings')->delete();
        DB::table('ikas_parser_settings')->insert([
            [
                'name' => 'bestchange.file_dir.source.info',
                'value' => 'http://www.bestchange.ru/bm/info.zip',
                'default' => 'http://www.bestchange.ru/bm/info.zip'
            ],
            [
                'name' => 'bestchange.file_dir.info',
                'value' => 'storage/app/uploads/public/info.zip',
                'default' => 'storage/app/uploads/public/info.zip'
            ],
            [
                'name' => 'bestchange.file_dir.unzip.info',
                'value' => 'storage/app/uploads/public/exchange/',
                'default' => 'storage/app/uploads/public/exchange/'
            ],
            [
                'name' => 'bestchange.file_list.parse',
                'value' => 'bm_bcodes.dat|bm_brates.dat|bm_cy.dat|bm_exch.dat|bm_info.dat|bm_news.dat|bm_rates.dat|bm_top.dat',
                'default' => 'bm_bcodes.dat|bm_brates.dat|bm_cy.dat|bm_exch.dat|bm_info.dat|bm_news.dat|bm_rates.dat|bm_top.dat'
            ],
        ]);
    }
}

