<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo
     */
    public function friendship()
    {
        return $this->belongsTo(Friendship::class);
    }
}
