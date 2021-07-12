<?php


namespace App\Src\Domain\ApplicationModels;


abstract class SystemDefaultException extends \Exception
{
    abstract function respond(): void;
    abstract function getLogInfo(): string;
}
