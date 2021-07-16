<?php


namespace App\Src\Domain\RequestModels;


use App\Src\Business\Utils\HttpUtils;
use App\Src\Domain\Model;
use Symfony\Component\HttpFoundation\Request;

abstract class RequestModel extends Model
{
    protected function getRequestBody(): array
    {
        return HttpUtils::requestBody();
    }
}
