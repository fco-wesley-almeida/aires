<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property Friend[] $friends
 */
class Friendship extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'friendship';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return HasMany
     */
    public function friends()
    {
        return $this->hasMany(Friend::class);
    }
}
