<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/*
 * @property int $id
 * @property int $post_id
 * @property int $customer_id
 * @property string $text
 * @property int $likes
*/
class PostComment extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_comment';

    public array $tree = [];
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['post_id', 'customer_id', 'text', 'likes'];
    
}
