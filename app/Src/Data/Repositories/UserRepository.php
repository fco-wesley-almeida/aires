<?php


namespace App\Src\Data\Repositories;


use App\Src\Business\Mappers\UserCreateMapper;
use App\Src\Domain\EloquentModels\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{
    /**
     * @throws QueryException
     * @throws \Exception
     */
    public static function create(User $user): int
    {
        $user->createTree();
        return $user->id;
    }
}
