<?php


namespace App\Src\Data\Dao;


use App\Src\Data\Dao\Interfaces\DbInstance;
use App\Src\Data\Dao\Interfaces\IUserDb;
use App\Src\Data\Databases\AiresDb;
use App\Src\Data\Exceptions\DatabaseConnectionException;
use App\Src\Data\Exceptions\PdoFetchFailureException;
use App\Src\Domain\ResponseModels\UserResponseModel;
use Exception;
use Illuminate\Support\Collection;

class UserDb implements DbInstance, IUserDb
{
    public function mapper(): callable
    {
        return function (array $row): UserResponseModel
        {
            $user = UserResponseModel::Builder()
                ->setUserId($row['userId'])
                ->setNickname($row['nickname'])
                ->setEmail($row['email'])
                ->setAlias($row['alias'])
                ->setCostumerId($row['costumerId'])
                ->setName($row['name']);
            return $user;
        };
    }

    /**
     * @throws DatabaseConnectionException
     * @throws PdoFetchFailureException
     * @throws Exception
     */
    public function getUserList(): Collection
    {
        $db = new AiresDb();
        $sql = <<<SQL
            SELECT
                u.id AS userId,
                u.nickname AS nickname,
                u.email AS email,
                IF (p.name IS NULL, '', p.name) AS name,
                IF (p.alias IS NULL, '', p.alias) AS alias,
                IF (c.id IS NULL, 0 , c.id) AS costumerId
            FROM user u
            LEFT JOIN person p on u.id = p.user_id
            LEFT JOIN customer c on u.id = c.user_id
        SQL;
        $binds = [];
        $db->connect();
        $db->query($sql, $binds);
        $userList = $db->getResultArray($this->mapper());
        return $userList;
    }

    /**
     * @throws DatabaseConnectionException
     * @throws PdoFetchFailureException
     * @throws Exception
     */
    public function getUserById(int $userId): UserResponseModel
    {
        $db = new AiresDb();
        $sql = <<<SQL
            SELECT
                u.id AS userId,
                u.nickname AS nickname,
                u.email AS email,
                IF (p.name IS NULL, '', p.name) AS name,
                IF (p.alias IS NULL, '', p.alias) AS alias,
                IF (c.id IS NULL, 0 , c.id) AS costumerId
            FROM user u
            LEFT JOIN person p on u.id = p.user_id
            LEFT JOIN customer c on u.id = c.user_id
            WHERE
                u.id = :userId
        SQL;
        $binds = [
            'userId' => $userId
        ];
        $db->connect();
        $db->query($sql, $binds);
        $user = $db->getResultObj($this->mapper());
        return $user;
    }
}
