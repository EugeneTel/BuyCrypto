<?php namespace Ikas\Parser\Models;

use Model;

/**
 * BCHMoneyCode Model
 */
class BCHMoneyCode extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'ikas_parser_bch_money_codes';

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
