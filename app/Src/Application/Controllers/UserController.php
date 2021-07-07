<?php

namespace App\Src\Application\Controllers;

use App\Src\Business\Mappers\GenericMapper;
use App\Src\Business\Services\UserService;
use App\Src\Domain\ApplicationModels\BaseResponse;

class UserController extends Controller
{
    public function getUsersList():array
    {
        $userCollection = UserService::getUserList();
        $userArray = GenericMapper::CollectionToArray($userCollection);
        $baseResponse = new BaseResponse('Users found.', $userArray);
        return $baseResponse->toArray();
    }
    public function getUser(int $userId): array
    {
        return ['a' => $userId];
    }
}
