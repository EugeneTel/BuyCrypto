<?php namespace Ikas\Parser\Models;

use Laradev\Crypto\Models\Pair;
use Laradev\Crypto\Models\Provider;
use Model;

/**
 * Model
 */
class CryptowatchData extends Model
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
    public $table = 'ikas_parser_cryptowatch';
    
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
    
    public function getProvidersIdOptions(){
        $providers = Provider::all()->pluck('name', 'id')->toArray();
        return $providers;
    }

    public function getPairsIdOptions(){
        $pairs = Pair::all()->pluck('name', 'id')->toArray();
        return $pairs;
    }

}