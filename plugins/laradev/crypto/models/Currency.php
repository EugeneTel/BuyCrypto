<?php namespace Laradev\Crypto\Models;

use Model;

/**
 * Currency Model
 */
class Currency extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'laradev_crypto_currencies';

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
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    const TYPE_FIAT = 1;
    const TYPE_CRYPTO = 2;
    const TYPE_TRADE = 3;
}
