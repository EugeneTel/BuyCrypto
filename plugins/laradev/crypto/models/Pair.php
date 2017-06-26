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
}
