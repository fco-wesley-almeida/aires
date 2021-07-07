<?php


namespace App\Src\Domain;


class Model
{
    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            if (isset($value)) {
                $array[$key] = $value;
            }
        }
        return $array;
    }
}
