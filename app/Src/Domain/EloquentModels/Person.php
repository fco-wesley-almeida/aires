<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $alias
 * @property string $birth_date
 * @property User $user
 */
class Person extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person';
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'alias', 'birth_date'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
