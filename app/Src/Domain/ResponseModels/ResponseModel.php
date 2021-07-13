<?php


namespace App\Src\Domain\ResponseModels;


abstract class ResponseModel extends \App\Src\Domain\Model
{
    public abstract static function Builder();
}
