<?php

namespace App\Src\Business\Services\Interfaces;

use App\Src\Domain\RequestModels\UserCreateRequestModel;
use App\Src\Domain\ResponseModels\UserResponseModel;
use Illuminate\Support\Collection;

interface IUserService {

    public function getUserList(): Collection;
    public function getUserById(int $id): UserResponseModel;
    public function createUser(UserCreateRequestModel $userRequest): int;
}
