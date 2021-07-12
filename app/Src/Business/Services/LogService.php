<?php


namespace App\Src\Business\Services;

use App\Src\Domain\ApplicationModels\SystemDefaultException;
use Illuminate\Support\Facades\Log;
use PDOException;
use Exception;

class LogService
{
    public static function logInfo(string $info, array $context = []): void
    {
        Log::info('', $context);
    }

    public static function logSystemException (SystemDefaultException $exception)
    {
        Log::error($exception->getLogInfo() . " === " . $exception->getMessage());
    }

    public static function logException (Exception $exception)
    {
        $arr = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'trace'  => $exception->getTraceAsString(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine()
        ];
        Log::error(json_encode($arr));
    }

    public static function logPdoException (PDOException $pdoException)
    {
        $pdoExceptionArray = [
            'code' => $pdoException->getCode(),
            'message' => $pdoException->getMessage(),
            'trace' => $pdoException->getTraceAsString(),
            'errorInfo' => $pdoException->errorInfo
        ];
        Log::error(
           json_encode($pdoExceptionArray)
        );
    }
}
