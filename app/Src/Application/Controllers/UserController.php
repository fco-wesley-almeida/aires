<?php

namespace App\Src\Application\Controllers;

use App\Src\Business\Mappers\GenericMapper;
use App\Src\Business\Services\LogService;
use App\Src\Business\Services\UserService;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Exception;

class UserController extends Controller
{
    public function getUserList(): void
    {
        try
        {
            $userCollection = UserService::getUserList();
            $userArray = GenericMapper::CollectionToArray($userCollection);
            BaseResponse::builder()
                ->setMessage("Users found")
                ->setData($userArray)
                ->respond();
        }
        catch (SystemDefaultException $exception)
        {
            LogService::logSystemException($exception);
            $exception->respond();
        }
        catch (Exception $exception)
        {
            LogService::logException($exception);
            $this->breakApp();
        }
    }
    public function getUser(int $userId): array
    {
        return ['a' => $userId];
    }
}
