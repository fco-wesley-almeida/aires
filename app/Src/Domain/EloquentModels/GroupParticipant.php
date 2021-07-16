<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $group_id
 * @property Customer $customer
 * @property Group $group
 */
class GroupParticipant extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_participant';

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'group_id'];

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
