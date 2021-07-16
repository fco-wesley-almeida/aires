<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property User $user
 * @property ConversationMessage[] $conversationMessages
 * @property Friend[] $friends
 * @property FriendshipInvitation[] $requesterFriendshipInvitations
 * @property FriendshipInvitation[] $targetFriendshipInvitations
 * @property GroupParticipant[] $groupParticipants
 * @property Post[] $posts
 * @property PostComment[] $postComments
 */
class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function conversationMessages(): HasMany
    {
        return $this->hasMany(ConversationMessage::class);
    }

    /**
     * @return HasMany
     */
    public function friends(): HasMany
    {
        return $this->hasMany(Friend::class);
    }

    /**
     * @return HasMany
     */
    public function requesterFriendshipInvitations(): HasMany
    {
        return $this->hasMany(FriendshipInvitation::class, 'requester_customer_id');
    }

    /**
     * @return HasMany
     */
    public function targetFriendshipInvitations(): HasMany
    {
        return $this->hasMany(FriendshipInvitation::class, 'target_customer_id');
    }

    /**
     * @return HasMany
     */
    public function groupParticipants(): HasMany
    {
        return $this->hasMany(GroupParticipant::class);
    }

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_customer_id');
    }

    /**
     * @return HasMany
     */
    public function postComments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }
}
