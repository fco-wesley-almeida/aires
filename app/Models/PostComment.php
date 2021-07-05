<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
