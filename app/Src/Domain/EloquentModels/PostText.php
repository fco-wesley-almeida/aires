<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $post_id
 * @property string $text
 * @property Post $post
 */
class PostText extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_text';

    /**
     * @var array
     */
    protected $fillable = ['post_id', 'text'];

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
