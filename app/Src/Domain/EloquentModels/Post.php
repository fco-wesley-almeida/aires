<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $author_customer_id
 * @property string $register_date
 * @property int $likes
 * @property Customer $customer
 * @property PostComment[] $postComments
 * @property PostImage[] $postImages
 * @property PostText $postText
 */
class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';

    /**
     * @var array
     */
    protected $fillable = ['author_customer_id', 'register_date', 'likes'];

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'author_customer_id');
    }

    /**
     * @return HasMany
     */
    public function postComments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    /**
     * @return HasMany
     */
    public function postImages(): HasMany
    {
        return $this->hasMany(PostImage::class);
    }

    /**
     * @return HasOne
     */
    public function postText(): HasOne
    {
        return $this->hasOne(PostText::class, 'post_id');
    }
}
