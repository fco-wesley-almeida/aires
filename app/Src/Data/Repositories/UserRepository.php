<?php


namespace App\Src\Data\Repositories;


use App\Src\Data\Repositories\Interfaces\IUserRepository;
use App\Src\Domain\EloquentModels\User;
use Exception;
use Illuminate\Database\QueryException;

class UserRepository extends Repository implements IUserRepository
{
    /**
     * @throws QueryException
     * @throws Exception
     */
    public function create(User $user): int
    {
        $user->createTree();
        return $user->id;
    }
}
