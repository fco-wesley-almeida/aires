<?php
namespace App\Src\Data\Dao\Interfaces;

interface DbInstance
{
    public function mapper(): callable;
}
