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
                'name' => 'bestchange.file_dir.info',
                'value' => 'storage/app/uploads/public/info.zip'
            ],
            [
                'name' => 'bestchange.file_dir.unzip.info',
                'value' => 'storage/app/uploads/public/exchange/'
            ],
        ]);
    }
}

