<?php

namespace App\Src\Domain\EloquentModels;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $email
 * @property string $nickname
 * @property Admin[] $admins
 * @property Customer[] $customers
 * @property Password[] $passwords
 * @property Person[] $people
 */
class User extends EloquentModel
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

    public array $tree = [
        'admins' => [Admin::class],
        'customers' => [Customer::class],
        'passwords' => [Password::class],
        'people' => [Person::class]
    ];

//    public ?array $admins = null;
//    public ?array $customers = null;
//    public ?array $passwords = null;
//    public ?array $people = null;


    /**
     * @return HasMany
     */
    public function getAdmins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * @return HasMany
     */
    public function getCustomers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * @return HasMany
     */
    public function getPasswords(): HasMany
    {
        return $this->hasMany(Password::class);
    }

    public function getPerson(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
