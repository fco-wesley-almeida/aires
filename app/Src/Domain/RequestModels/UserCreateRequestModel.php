<?php


namespace App\Src\Domain\RequestModels;


use Symfony\Component\HttpFoundation\Request;

class UserCreateRequestModel extends RequestModel
{
    protected string $nickname;
    protected string $email;
    protected string $password;
    protected string $name;
    protected string $alias;
    protected string $birthDate;

    public function __construct()
    {
        $body = $this->getRequestBody();
        $this->nickname = $body['nickname'];
        $this->email = $body['email'];
        $this->password = $body['password'];
        $this->name = $body['name'];
        $this->alias = $body['alias'];
        $this->birthDate = $body['birthDate'];
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
    public function getPassword(): string
    {
        return $this->password;
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
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }


    /**
     * @param string $nickname
     * @return UserCreateRequestModel
     */
    public function setNickname(string $nickname): UserCreateRequestModel
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @param string $email
     * @return UserCreateRequestModel
     */
    public function setEmail(string $email): UserCreateRequestModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return UserCreateRequestModel
     */
    public function setPassword(string $password): UserCreateRequestModel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $name
     * @return UserCreateRequestModel
     */
    public function setName(string $name): UserCreateRequestModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $alias
     * @return UserCreateRequestModel
     */
    public function setAlias(string $alias): UserCreateRequestModel
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @param string $birthDate
     * @return UserCreateRequestModel
     */
    public function setBirthDate(string $birthDate): UserCreateRequestModel
    {
        $this->birthDate = $birthDate;
        return $this;
    }


}
