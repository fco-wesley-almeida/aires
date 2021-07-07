<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversationMessages()
    {
        return $this->hasMany('App\ConversationMessage');
    }
}
