<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/*
 * @property int $id
 * @property ConversationMessage[] $conversationMessages
*/
class Conversation extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversation';

    public array $tree = [
        'conversationMessages' => [ConversationMessage::class]
    ];

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [];
    
    public function getConversationMessages(): HasMany
    {
        return $this->hasMany(ConversationMessage::class);
    }

}
