<?php


namespace App\Src\Business\Services;

use App\Src\Business\Exceptions\NotFoundException;
use App\Src\Business\Exceptions\ValidationErrorException;
use App\Src\Business\Mappers\UserCreateMapper;
use App\Src\Business\Validations\UserCreateValidation;
use App\Src\Data\Dao\UserDb;
use App\Src\Data\Exceptions\DatabaseConnectionException;
use App\Src\Data\Exceptions\PdoFetchFailureException;
use App\Src\Data\Repositories\UserRepository;
use App\Src\Domain\RequestModels\UserCreateRequestModel;
use App\Src\Domain\ResponseModels\UserResponseModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

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

    /**
     * @throws ValidationErrorException
     */
    public static function createUser(UserCreateRequestModel $userRequest): int
    {
        $mapper = new UserCreateMapper($userRequest);
        $validation = new UserCreateValidation();
        try {
           $user = $mapper->getUser();
           return UserRepository::create($user);
        } catch (QueryException $exception) {
           $validation->validatePersistenceErrors($exception);
        }
    }

}
