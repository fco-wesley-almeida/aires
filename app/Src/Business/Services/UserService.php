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
        try {
            return UserDb::getUserList();
        } catch (Exception $e) {
            var_dump($e);
        }
    }
}
