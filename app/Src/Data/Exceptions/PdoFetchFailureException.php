<?php


namespace App\Src\Data\Exceptions;


use App\Src\Business\Utils\DefaultErrorMessages;
use App\Src\Data\Dao\Db;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PdoFetchFailureException extends SystemDefaultException
{
    private Db $db;
    public function __construct(Db $db, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->db = $db;
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
            Error on fetch query result on database {$this->db->getDatabase()} on host {$this->db->getHostspec()}.
            Query: {$this->db->getSql()}.
        LOG;
    }
}
