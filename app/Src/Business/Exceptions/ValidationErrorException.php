<?php


namespace App\Src\Business\Exceptions;


use App\Src\Business\Utils\DefaultErrorMessages;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class ValidationErrorException extends SystemDefaultException
{
    protected array $errors;
    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct();
    }

    public function respond(): void
    {
        BaseResponse::builder()
            ->setMessage(DefaultErrorMessages::VALIDATION_FAILURE)
            ->setData($this->errors)
            ->setStatusCode(Response::HTTP_BAD_REQUEST)
            ->respond();
    }

    public function getLogInfo(): string
    {
        return '';
    }

}
