<?php


namespace App\Src\Data\Exceptions;


use App\Src\Business\Utils\DefaultErrorMessages;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PdoBindingFailureException extends SystemDefaultException
{
    private string $sql;
    private string $key;
    private $bind;
    private int $pdoParamType;

    public function __construct(
        string $sql,
        string $key,
        $bind,
        int $pdoParamType ,
        $message = "",
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->sql = $sql;
        $this->key = $key;
        $this->bind = $bind;
        $this->pdoParamType = $pdoParamType;
        parent::__construct($message, $code, $previous);
    }

    public function respond(): void
    {
        BaseResponse::builder()
            ->setMessage(DefaultErrorMessages::INTERNAL_SERVER_ERROR)
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respond();
    }

    function getLogInfo(): string
    {
        return <<<LOG
            Error on binding of param {$this->key} on query {$this->sql}.
            Bind value: {$this->bind}
            PDO Param type: {$this->pdoParamType}
        LOG;
    }

}
