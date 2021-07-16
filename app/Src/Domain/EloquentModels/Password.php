<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $password
 * @property User $user
 */
class Password extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'password'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
