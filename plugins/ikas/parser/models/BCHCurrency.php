<?php namespace Ikas\Parser\Models;

use Model;

/**
 * BCHMoney Model
 */
class BCHCurrency extends Model
{

    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ikas_parser_bch_currency';

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
