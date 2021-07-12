<?php


namespace App\Src\Data\Exceptions;

use App\Src\Business\Utils\DefaultErrorMessages;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class InvalidEnvironmentException extends SystemDefaultException
{
    private string $envProvided;
    public function __construct(string $envProvided, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function respond(): void
    {
        BaseResponse::builder()
            ->setMessage(DefaultErrorMessages::INTERNAL_SERVER_ERROR)
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respond();
    }

    public function getLogInfo(): string
    {
        return <<<LOG
            The environment setting provided was {$this->envProvided}
        LOG;
    }


}
