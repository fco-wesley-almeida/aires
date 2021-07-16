<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $post_id
 * @property int $customer_id
 * @property string $text
 * @property int $likes
 * @property Customer $customer
 * @property Post $post
 */
class PostComment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_comment';

    /**
     * @var array
     */
    protected $fillable = ['post_id', 'customer_id', 'text', 'likes'];

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
