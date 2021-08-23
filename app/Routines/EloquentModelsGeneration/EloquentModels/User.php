<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/*
 * @property int $id
 * @property string $email
 * @property string $nickname
 * @property Admin[] $admins
 * @property Customer[] $customers
 * @property Password[] $passwords
 * @property Person $person
*/
class User extends EloquentModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    public array $tree = [
        'admins' => [Admin::class],
        'customers' => [Customer::class],
        'passwords' => [Password::class],
        'person' => [Person::class],
    ];

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['email', 'nickname'];
    
    public function getAdmins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    public function getCustomers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function getPasswords(): HasMany
    {
        return $this->hasMany(Password::class);
    }

    public function getPerson(): HasOne
    {
        return $this->hasOne(Person::class);
    }

}
