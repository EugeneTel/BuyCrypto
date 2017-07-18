<?php namespace Laradev\Crypto\Models;

use Model;

/**
 * OfferStep Model
 */
class OfferStep extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'laradev_crypto_offer_steps';

    public $timestamps = false;

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['offer_id', 'step_id', 'provider_id', 'pair_provider_id', 'price', 'time_avg', 'order'];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'pairProvider' => PairProvider::class,
        'provider' => Provider::class,
        'offer' => Offer::class,
        'step' => Step::class,
    ];

}
