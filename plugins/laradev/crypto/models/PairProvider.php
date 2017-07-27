<?php namespace Laradev\Crypto\Models;

use Model;

/**
 * PairProvider Model
 */
class PairProvider extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'laradev_crypto_pair_providers';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'pair' => ['Laradev\Crypto\Models\Pair'],
        'provider' => ['Laradev\Crypto\Models\Provider'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
