<?php


namespace App\Src\Business\Services;


use App\Src\Data\Dao\UserDb;
use Exception;
use Illuminate\Support\Collection;

class UserService
{
    /**
     * @throws Exception
     */
    public static function getUserList(): Collection
    {
        return UserDb::getUserList();
    }
}
