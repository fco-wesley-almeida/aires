<?php


namespace App\Src\Business\Utils;


class HttpUtils
{
    public static function requestBody(): array
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
