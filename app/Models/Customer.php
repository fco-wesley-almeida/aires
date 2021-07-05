<?php

namespace App\Models;

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

    /**
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversationMessages()
    {
        return $this->hasMany('App\ConversationMessage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friends()
    {
        return $this->hasMany('App\Friend');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requesterFriendshipInvitations()
    {
        return $this->hasMany('App\FriendshipInvitation', 'requester_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function targetFriendshipInvitations()
    {
        return $this->hasMany('App\FriendshipInvitation', 'target_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupParticipants()
    {
        return $this->hasMany('App\GroupParticipant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post', 'author_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postComments()
    {
        return $this->hasMany('App\PostComment');
    }
}
