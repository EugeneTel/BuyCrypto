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
    ];
}
