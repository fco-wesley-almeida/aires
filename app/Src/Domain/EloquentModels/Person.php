<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $alias
 * @property string $birth_date
*/
class Person extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person';

    public array $tree = [];
    
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'alias', 'birth_date'];
    
}
