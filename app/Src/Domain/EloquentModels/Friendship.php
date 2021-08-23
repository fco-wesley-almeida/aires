<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property Friend[] $friends
*/
class Friendship extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'friendship';

    public array $tree = [
        'friends' => [Friend::class]
    ];

    
    public ?array $friends = null;
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [];
    
    public function getFriends(): HasMany
    {
        return $this->hasMany(Friend::class);
    }

}
