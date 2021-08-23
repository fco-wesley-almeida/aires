<?php


namespace App\Src\Data\Repositories\Interfaces;


use App\Src\Domain\EloquentModels\User;

interface IUserRepository
{

    public function create(User $user): int;
}
