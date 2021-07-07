<?php


namespace App\Src\Business\Mappers;


use App\Src\Domain\Model;
use Illuminate\Support\Collection;

class GenericMapper
{
    public static function CollectionToArray(Collection $collection): array
    {
        $array = [];
        $collection->each(function (Model $model) use (&$array){
           $array[] = $model->toArray();
        });
        return $array;
    }
}
