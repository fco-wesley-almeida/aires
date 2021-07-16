<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $requester_customer_id
 * @property int $target_customer_id
 * @property int $accepted
 * @property Customer $requesterCustomer
 * @property Customer $targetCustomer
 */
class FriendshipInvitation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'friendship_invitation';

    /**
     * @var array
     */
    protected $fillable = ['requester_customer_id', 'target_customer_id', 'accepted'];

    /**
     * @return BelongsTo
     */
    public function requesterCustomer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'requester_customer_id');
    }

    /**
     * @return BelongsTo
     */
    public function targetCustomer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'target_customer_id');
    }
}
