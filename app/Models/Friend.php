<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $friendship_id
 * @property Customer $customer
 * @property Friendship $friendship
 */
class Friend extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'friend';

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'friendship_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function friendship()
    {
        return $this->belongsTo('App\Friendship');
    }
}
