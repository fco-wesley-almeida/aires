<?php


namespace App\Src\Data\Dao\Interfaces;


use App\Src\Domain\ResponseModels\UserResponseModel;
use Illuminate\Support\Collection;

interface IUserDb
{
    public function getUserById(int $userId): UserResponseModel;
    public function getUserList(): Collection;
}
