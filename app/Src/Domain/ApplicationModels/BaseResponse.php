<?php


namespace App\Src\Domain\ApplicationModels;



use Symfony\Component\HttpFoundation\Response;

class BaseResponse extends \App\Src\Domain\Model
{
    protected string $message;
    protected $data;
    protected int $statusCode = 200;

    public static function builder (): BaseResponse
    {
        return new BaseResponse();
    }

    /**
     * @param string $message
     * @return BaseResponse
     */
    public function setMessage(string $message): BaseResponse
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param mixed $data
     * @return BaseResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param int $statusCode
     * @return BaseResponse
     */
    public function setStatusCode(int $statusCode = Response::HTTP_OK): BaseResponse
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function toArray (): array
    {
        $response = ['message' => $this->message];
        if (is_null($this->data))
        {
            return $response;
        }
        $dataType = gettype($this->data);
        if (!in_array($dataType, ['array', 'integer', 'string']))
        {
            $this->data = $this->data->toArray();
        }
        $response['data'] = $this->data;
        return $response;
    }

    public function respond(): void
    {
        echo json_encode(
            $this->toArray()
        );
        header('Content-Type: application/json');
        http_response_code($this->statusCode);
        exit;
    }
}
