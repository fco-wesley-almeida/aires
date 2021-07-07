<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Src\Domain\EloquentModels\Post');
    }
}
