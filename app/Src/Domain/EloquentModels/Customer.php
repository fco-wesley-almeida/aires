<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversationMessages()
    {
        return $this->hasMany(ConversationMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requesterFriendshipInvitations()
    {
        return $this->hasMany(FriendshipInvitation::class, 'requester_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function targetFriendshipInvitations()
    {
        return $this->hasMany(FriendshipInvitation::class, 'target_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupParticipants()
    {
        return $this->hasMany(GroupParticipant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }
}
