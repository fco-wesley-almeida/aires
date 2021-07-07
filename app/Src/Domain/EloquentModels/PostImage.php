<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Src\Domain\EloquentModels\Post');
    }
}
