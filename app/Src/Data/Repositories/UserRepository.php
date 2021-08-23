<?php


namespace App\Src\Data\Repositories;


use App\Src\Domain\EloquentModels\User;
use Exception;
use Illuminate\Database\QueryException;

class UserRepository extends Repository
{
    /**
     * @throws QueryException
     * @throws Exception
     */
    public static function create(User $user): int
    {
        $user->createTree();
        return $user->id;
    }
}
