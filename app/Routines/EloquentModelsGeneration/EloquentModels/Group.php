<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/*
 * @property int $id
 * @property string $name
 * @property GroupParticipant[] $groupParticipants
*/
class Group extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group';

    public array $tree = [
        'groupParticipants' => [GroupParticipant::class]
    ];

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name'];
    
    public function getGroupParticipants(): HasMany
    {
        return $this->hasMany(GroupParticipant::class);
    }

}
