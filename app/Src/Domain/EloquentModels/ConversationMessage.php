<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $conversation_id
 * @property string $message
 * @property Conversation $conversation
 * @property Customer $customer
 */
class ConversationMessage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversation_message';

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'conversation_id', 'message'];

    /**
     * @return BelongsTo
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
