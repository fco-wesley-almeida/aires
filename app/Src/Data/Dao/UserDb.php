<?php


namespace App\Src\Data\Dao;


use App\Src\Data\Dao\Interfaces\DbInstance;
use App\Src\Data\Databases\AiresDb;
use App\Src\Data\Exceptions\DatabaseConnectionException;
use App\Src\Data\Exceptions\DatabaseQueryException;
use App\Src\Data\Exceptions\PdoFetchFailureException;
use App\Src\Domain\EntityModels\User;
use Exception;
use Illuminate\Support\Collection;

class UserDb implements DbInstance
{
    public static function mapper(): callable
    {
        return function (array $row): User
        {
            $user = new User;
            $user->setId($row['id']);
            $user->setEmail($row['email']);
            $user->setNickname($row['nickname']);
            return $user;
        };
    }

    /**
     * @throws DatabaseConnectionException
     * @throws PdoFetchFailureException
     * @throws Exception
     */
    public static function getUserList(): Collection
    {
        $db = new AiresDb();
        $sql = <<<SQL
            SELECT
                u.id,
                u.email,
                u.nickname
            FROM `user` u
        SQL;
        $binds = [];
        $db->connect();
        $db->query($sql, $binds);
        return $db->getResultArray(self::mapper());
    }
}
