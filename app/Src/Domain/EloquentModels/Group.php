<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property GroupParticipant[] $groupParticipants
 */
class Group extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function groupParticipants(): HasMany
    {
        return $this->hasMany(GroupParticipant::class);
    }
}
