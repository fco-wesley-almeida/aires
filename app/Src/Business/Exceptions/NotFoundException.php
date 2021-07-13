<?php


namespace App\Src\Business\Exceptions;


use App\Src\Business\Utils\DefaultErrorMessages;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends SystemDefaultException
{
    protected array $errors;

    public function respond(): void
    {
        BaseResponse::builder()
            ->setMessage($this->getMessage())
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respond();
    }

    public function getLogInfo(): string
    {
        return '';
    }
}
