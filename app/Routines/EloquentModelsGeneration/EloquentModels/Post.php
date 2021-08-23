<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/*
 * @property int $id
 * @property int $author_customer_id
 * @property string $register_date
 * @property int $likes
 * @property PostComment[] $postComments
 * @property PostImage[] $postImages
 * @property PostText $postText
*/
class Post extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';

    public array $tree = [
        'postComments' => [PostComment::class],
        'postImages' => [PostImage::class],
        'postText' => [PostText::class],
    ];

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['author_customer_id', 'register_date', 'likes'];
    
    public function getPostComments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    public function getPostImages(): HasMany
    {
        return $this->hasMany(PostImage::class);
    }

    public function getPostText(): HasOne
    {
        return $this->hasOne(PostText::class);
    }

}
