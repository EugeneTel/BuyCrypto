<?php namespace Ikas\Parser\Models;

use Model;

/**
 * CrypProvider Model
 */
class CrypProvider extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'ikas_parser_cryp_providers';

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
