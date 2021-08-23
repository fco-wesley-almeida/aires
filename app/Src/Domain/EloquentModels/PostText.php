<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $post_id
 * @property string $text
*/
class PostText extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_text';

    public array $tree = [];
    
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['post_id', 'text'];
    
}
