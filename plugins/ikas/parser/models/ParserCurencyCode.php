<?php namespace Ikas\Parser\Models;

use Illuminate\Support\Facades\Input;
use Laradev\Crypto\Models\Currency;
use Model;

/**
 * Model
 */
class ParserCurencyCode extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ikas_parser_currency_codes';

    public function getCryptoCurrenciesIdOptions(){
        $systemCurrency = ['null' => 'No relation'];
        $systemCurrency = array_merge($systemCurrency, Currency::all()->pluck('name', 'id')->toArray());
        return $systemCurrency;
    }

    public function beforeCreate(){
        $data = Input::get('ParserCurencyCode');
        if($data['crypto_currencies_id'] === 'null'){
            $this->crypto_currencies_id = null;
        };
    }

}