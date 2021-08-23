<?php


namespace App\Src\Business\Services;

use App\Src\Business\Exceptions\NotFoundException;
use App\Src\Business\Exceptions\ValidationErrorException;
use App\Src\Business\Mappers\Interfaces\IUserCreateMapper;
use App\Src\Business\Mappers\UserCreateMapper;
use App\Src\Business\Services\Interfaces\IUserService;
use App\Src\Business\Validations\UserCreateValidation;
use App\Src\Data\Dao\Interfaces\IUserDb;
use App\Src\Data\Dao\UserDb;
use App\Src\Data\Exceptions\DatabaseConnectionException;
use App\Src\Data\Exceptions\PdoFetchFailureException;
use App\Src\Data\Repositories\Interfaces\IUserRepository;
use App\Src\Data\Repositories\UserRepository;
use App\Src\Domain\RequestModels\UserCreateRequestModel;
use App\Src\Domain\ResponseModels\UserResponseModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

/**
 * Class UserService
 * @package App\Src\Business\Services
 */
class UserService implements IUserService
{
    private IUserDb $userDb;
    private IUserCreateMapper $userCreateMapper;
    private IUserRepository $userRepository;

    public function __construct(
        IUserDb $userDb,
        IUserCreateMapper $userCreateMapper,
        IUserRepository $userRepository
    )
    {
       $this->userDb = $userDb;
       $this->userCreateMapper = $userCreateMapper;
       $this->userRepository = $userRepository;
    }

    /**
     * @return Collection
     */
    public function getUserList(): Collection
    {
        return $this->userDb->getUserList();
    }

    /**
     * @param int $userId
     * @return UserResponseModel
     * @throws NotFoundException
     */
    public function getUserById(int $userId): UserResponseModel
    {
        try {
            $user = $this->userDb->getUserById($userId);
        } catch (PdoFetchFailureException $fetchFailureException) {
           throw new NotFoundException("User not found.");
        }
        return $user;
    }

    /**
     * @throws ValidationErrorException
     */
    public function createUser(UserCreateRequestModel $userRequest): int
    {
        $validation = new UserCreateValidation();
        try {
           $this->userCreateMapper->setBaseMapping($userRequest);
           $user = $this->userCreateMapper->getUser();
           return $this->userRepository->create($user);
        } catch (QueryException $exception) {
           $validation->validatePersistenceErrors($exception);
           return 0;
        }
    }

}
