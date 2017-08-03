<?php namespace Ikas\Parser\Models;

use Model;

/**
 * CrypCurrency Model
 */
class CrypCurrency extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'ikas_parser_cryp_currencies';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['id', 'fiat'];

    public $timestamps = false;

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
