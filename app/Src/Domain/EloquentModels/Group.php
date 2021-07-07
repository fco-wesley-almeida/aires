<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupParticipants()
    {
        return $this->hasMany('App\GroupParticipant');
    }
}
