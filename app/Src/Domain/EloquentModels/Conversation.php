<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property ConversationMessage[] $conversationMessages
 */
class Conversation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversation';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return HasMany
     */
    public function conversationMessages()
    {
        return $this->hasMany(ConversationMessage::class);
    }
}
