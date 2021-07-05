<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'password'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
