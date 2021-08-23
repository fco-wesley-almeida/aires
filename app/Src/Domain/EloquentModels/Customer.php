<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property ConversationMessage[] $conversationMessages
 * @property Friend[] $friends
 * @property FriendshipInvitation[] $friendshipInvitations
 * @property GroupParticipant[] $groupParticipants
 * @property Post[] $posts
 * @property PostComment[] $postComments
*/
class Customer extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';

    public array $tree = [
        'conversationMessages' => [ConversationMessage::class],
        'friends' => [Friend::class],
        'friendshipInvitations' => [FriendshipInvitation::class],
        'groupParticipants' => [GroupParticipant::class],
        'posts' => [Post::class],
        'postComments' => [PostComment::class],
    ];


    public ?array $conversationMessages = null;
    public ?array $friends = null;
    public ?array $friendshipInvitations = null;
    public ?array $groupParticipants = null;
    public ?array $posts = null;
    public ?array $postComments = null;
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id'];

    public function getConversationMessages(): HasMany
    {
        return $this->hasMany(ConversationMessage::class);
    }

    public function getFriends(): HasMany
    {
        return $this->hasMany(Friend::class);
    }

    public function getFriendshipInvitations(): HasMany
    {
        return $this->hasMany(FriendshipInvitation::class);
    }

    public function getGroupParticipants(): HasMany
    {
        return $this->hasMany(GroupParticipant::class);
    }

    public function getPosts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getPostComments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

}
