<?php
namespace App\Src\Data\Dao\Interfaces;

interface DbInstance
{
    static function mapper(): callable;
}
