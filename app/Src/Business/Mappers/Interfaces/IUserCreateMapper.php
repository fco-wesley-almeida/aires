<?php


namespace App\Src\Business\Mappers\Interfaces;


use App\Src\Domain\EloquentModels\User;
use App\Src\Domain\RequestModels\UserCreateRequestModel;

interface IUserCreateMapper
{
    public function getUser(): User;
    public function setBaseMapping(UserCreateRequestModel $user);
}
