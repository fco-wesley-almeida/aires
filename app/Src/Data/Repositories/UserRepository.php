<?php


namespace App\Src\Data\Repositories;


use App\Src\Business\Mappers\UserCreateMapper;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{
    /**
     * @throws QueryException
     */
    public static function create(UserCreateMapper $mapper): int
    {
        DB::beginTransaction();
        $user = $mapper->getUser();
        $result = $user->save()
            && $mapper->getCustomer()->save()
            && $mapper->getPerson()->save()
            && $mapper->getPassword()->save()
        ;
        if ($result)
        {
            DB::commit();
        }
        return $user->id;
    }
}
