<?php namespace Laradev\Crypto\Models;

use Model;

/**
 * Pair Model
 */
class Pair extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'laradev_crypto_pairs';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name', 'currency_from', 'currency_to', 'active'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'pairProviders' => PairProvider::class,
        'currencyFrom' => ['Laradev\Crypto\Models\Currency', 'key' => 'id', 'otherKey' => 'currency_from'],
        'currencyTo' => ['Laradev\Crypto\Models\Currency', 'key' => 'id', 'otherKey' => 'currency_to'],
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getCurrencyFromOptions(){
        return Currency::get()->pluck('name', 'id');
    }

    public function getCurrencyToOptions(){
        return Currency::get()->pluck('name', 'id');
    }

}
