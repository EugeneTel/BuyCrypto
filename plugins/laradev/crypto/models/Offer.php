<?php namespace Laradev\Crypto\Models;

use Model;
use October\Rain\Database\Traits\SoftDelete;

/**
 * Offer Model
 */
class Offer extends Model
{
    use SoftDelete;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'laradev_crypto_offers';

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
    public $hasMany = [
        'offerSteps' => OfferStep::class,
    ];
    public $belongsTo = [
        'way' => Way::class,
    ];
}
