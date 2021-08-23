<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $password
 * @property int $user_id
*/
class Password extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password';

    public array $tree = [];
    
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['password', 'user_id'];
    
}
