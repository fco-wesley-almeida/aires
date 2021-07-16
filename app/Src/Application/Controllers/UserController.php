<?php

namespace App\Src\Application\Controllers;

use App\Src\Business\Mappers\GenericMapper;
use App\Src\Business\Services\LogService;
use App\Src\Business\Services\UserService;
use App\Src\Business\Utils\HttpUtils;
use App\Src\Business\Validations\UserCreateValidation;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use App\Src\Domain\RequestModels\UserCreateRequestModel;
use Symfony\Component\HttpFoundation\Response;

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
    }
    public function getUser(int $userId): void
    {
        try
        {
            $user = UserService::getUserById($userId)->toArray();
            BaseResponse::builder()
                ->setMessage("User found")
                ->setData($user)
                ->respond();
        }
        catch (SystemDefaultException $exception)
        {
            LogService::logSystemException($exception);
            $exception->respond();
        }
    }

    public function createUser()
    {
        try {
            $validation = new UserCreateValidation();
            $validation->applyValidations(HttpUtils::requestBody());
            $user = new UserCreateRequestModel();
            $id = UserService::createUser($user);
            if (!$id) {
                BaseResponse::builder()
                    ->setMessage("Failure on user registration.")
                    ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                    ->respond();
            }
            BaseResponse::builder()
                ->setData($id)
                ->setMessage("User registered.")
                ->respond();
        } catch (SystemDefaultException $exception) {
            $exception->respond();
        }
    }
}
