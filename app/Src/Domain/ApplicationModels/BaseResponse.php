<?php


namespace App\Src\Domain\ApplicationModels;


class BaseResponse extends \App\Src\Domain\Model
{
    protected string $message;
    protected $data;

    public function __construct(string $message, $data)
    {
        $this->message = $message;
        $this->data = $data;
    }

    public function toArray (): array
    {
        $obj = ['message' => $this->message];
        $data = $this->data;
        if (gettype($this->data) !== 'array')
        {
            $data = $this->data->toArray();
        }
        $obj['data'] = $data;
        return $obj;
    }
}
