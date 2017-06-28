<?php namespace Laradev\Crypto\Models;

use Model;

/**
 * Way Model
 */
class Way extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'laradev_crypto_ways';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['hash', 'currency_from', 'currency_to'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'steps' => Step::class,
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
