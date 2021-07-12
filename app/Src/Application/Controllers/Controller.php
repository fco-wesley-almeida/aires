<?php

namespace App\Src\Application\Controllers;

use App\Src\Business\Utils\DefaultErrorMessages;
use App\Src\Domain\ApplicationModels\BaseResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function breakApp()
    {
        BaseResponse::builder()
            ->setMessage(DefaultErrorMessages::INTERNAL_SERVER_ERROR)
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respond();
    }
}
