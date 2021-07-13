<?php


namespace App\Src\Domain\RequestModels;


use App\Src\Domain\Model;
use Symfony\Component\HttpFoundation\Request;

abstract class RequestModel extends Model
{
    protected function getRequestBody(): array
    {
        $phpInput = file_get_contents("php://input");
        if (!$phpInput) {
            return [];
        }
        $jsonDecoded = json_decode($phpInput, true);
        if (!$jsonDecoded) {
            return [];
        }
        return $jsonDecoded;
    }
}
