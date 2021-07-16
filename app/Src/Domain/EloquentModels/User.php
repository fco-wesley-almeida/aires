<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $email
 * @property string $nickname
 * @property Admin[] $admins
 * @property Customer[] $customers
 * @property Password[] $passwords
 * @property Person[] $people
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['email', 'nickname'];


    /**
     * @var array
     */
    public const uniqueKeys = ['email_iudex' , 'nickname_iudex'];

    /**
     * @return HasMany
     */
    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * @return HasMany
     */
    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class);
    }

    /**
     * @return HasMany
     */
    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
