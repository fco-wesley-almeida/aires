<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requesterCustomer()
    {
        return $this->belongsTo('App\Src\Domain\EloquentModels\Customer', 'requester_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function targetCustomer()
    {
        return $this->belongsTo('App\Src\Domain\EloquentModels\Customer', 'target_customer_id');
    }
}
