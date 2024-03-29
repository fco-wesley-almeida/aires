<?php


namespace App\Src\Data\Exceptions;


use App\Src\Business\Utils\DefaultErrorMessages;
use App\Src\Data\Dao\Db;
use App\Src\Domain\ApplicationModels\BaseResponse;
use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DatabaseQueryException extends SystemDefaultException
{
    private Db $db;
    private array $binds;

    public function __construct(
        Db $db,
        array $binds,
        $message = "",
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->db = $db;
        $this->binds = $binds;
        parent::__construct($message, $code, $previous);
    }

    public function respond(): void
    {
        BaseResponse::builder()
            ->setMessage(DefaultErrorMessages::DATABASE_QUERY_ERROR)
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respond();
    }

    function getLogInfo(): string
    {
        $bindsJson = json_encode($this->binds);
        return <<<LOG
            Error on a query to the database {$this->db->getDatabase()} on host {$this->db->getHostspec()}.
            Query: "{$this->db->getSql()}"
            Binds: {$bindsJson}
        LOG;
    }

}
