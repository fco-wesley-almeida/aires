<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $post_id
 * @property string $path
 * @property Post $post
 */
class PostImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_image';

    /**
     * @var array
     */
    protected $fillable = ['post_id', 'path'];

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
