<?php


namespace App\Src\Domain\ResponseModels;


use App\Src\Domain\EntityModels\User;

/**
 * Class UserResponseModel
 * @package App\Src\Domain\ResponseModels
 */
class UserResponseModel extends ResponseModel
{

    /**
     * @var int
     */
    protected int $userId;
    /**
     * @var string
     */
    protected string $nickname;
    /**
     * @var string
     */
    protected string $email;
    /**
     * @var string
     */
    protected string $name;
    /**
     * @var string
     */
    protected string $alias;
    /**
     * @var int
     */
    protected int $costumerId;

    /**
     * @return UserResponseModel
     */
    public static function Builder(): UserResponseModel
    {
        return new UserResponseModel();
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return int
     */
    public function getCostumerId(): int
    {
        return $this->costumerId;
    }

    /**
     * @param int $userId
     * @return UserResponseModel
     */
    public function setUserId(int $userId): UserResponseModel
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param string $nickname
     * @return UserResponseModel
     */
    public function setNickname(string $nickname): UserResponseModel
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @param string $email
     * @return UserResponseModel
     */
    public function setEmail(string $email): UserResponseModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $name
     * @return UserResponseModel
     */
    public function setName(string $name): UserResponseModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $alias
     * @return UserResponseModel
     */
    public function setAlias(string $alias): UserResponseModel
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @param int $costumerId
     * @return UserResponseModel
     */
    public function setCostumerId(int $costumerId): UserResponseModel
    {
        $this->costumerId = $costumerId;
        return $this;
    }
}
