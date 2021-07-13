<?php


namespace App\Src\Business\Services;

use App\Src\Business\Exceptions\NotFoundException;
use App\Src\Data\Dao\UserDb;
use App\Src\Data\Exceptions\DatabaseConnectionException;
use App\Src\Data\Exceptions\PdoFetchFailureException;
use App\Src\Domain\EloquentModels\Customer;
use App\Src\Domain\EloquentModels\Password;
use App\Src\Domain\EloquentModels\Person;
use App\Src\Domain\EloquentModels\User;
use App\Src\Domain\RequestModels\UserCreateRequestModel;
use App\Src\Domain\ResponseModels\UserResponseModel;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Src\Business\Services
 */
class UserService
{
    /**
     * @return Collection
     * @throws PdoFetchFailureException
     * @throws DatabaseConnectionException
     */
    public static function getUserList(): Collection
    {
        return UserDb::getUserList();
    }

    /**
     * @param int $userId
     * @return UserResponseModel
     * @throws NotFoundException
     * @throws DatabaseConnectionException
     */
    public static function getUserById(int $userId): UserResponseModel
    {
        try {
            $user = UserDb::getUserById($userId);
        } catch (PdoFetchFailureException $fetchFailureException) {
           throw new NotFoundException("User not found.");
        }
        return $user;
    }

    public static function createUser(UserCreateRequestModel $userRequest): int
    {
        $user = new User();
        $customer = new Customer();
        $person = new Person();
        $password = new Password();

        $user->email = $userRequest->getEmail();
        $user->nickname = $userRequest->getNickname();

        DB::beginTransaction();

            if (!$user->save())
            {
                DB::rollBack();
                return 0;
            }

            $customer->user_id = $user->id;
            if (!$customer->save())
            {
                DB::rollBack();
                return 0;
            }

            $person->alias = $userRequest->getAlias();
            $person->user_id = $user->id;
            $person->name = $userRequest->getName();
            $person->birth_date = $userRequest->getBirthDate();

            if (!$person->save())
            {
                DB::rollBack();
                return 0;
            }

            $password->user_id = $user->id;
            $password->password = $userRequest->getPassword();

            if (!$password->save())
            {
                DB::rollBack();
                return 0;
            }

        DB::commit();
        return $user->id;
    }

}
