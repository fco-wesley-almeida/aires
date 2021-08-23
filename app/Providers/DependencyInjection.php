<?php


namespace App\Providers;


use App\Src\Business\Mappers\Interfaces\IUserCreateMapper;
use App\Src\Business\Mappers\UserCreateMapper;
use App\Src\Business\Services\Interfaces\IUserService;
use App\Src\Business\Services\UserService;
use App\Src\Data\Dao\Interfaces\IUserDb;
use App\Src\Data\Dao\UserDb;
use App\Src\Data\Repositories\Interfaces\IUserRepository;
use App\Src\Data\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;

class DependencyInjection
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    private function servicesConfiguration (): array
    {
        return [
            [IUserService::class, UserService::class],
        ];
    }

    private function mappersConfiguration (): array
    {
        return [
            [IUserCreateMapper::class, UserCreateMapper::class],
        ];
    }

    private function daoConfigurations (): array
    {
        return [
            [IUserDb::class, UserDb::class],
        ];
    }

    private function repositoriesConfigurations (): array
    {
        return [
            [IUserRepository::class, UserRepository::class]
        ];
    }

    public function configure()
    {
        $configurations = array_merge(
            $this->daoConfigurations(),
            $this->mappersConfiguration(),
            $this->repositoriesConfigurations(),
            $this->servicesConfiguration()
        );
        foreach ($configurations as $configuration)
        {
            $this->app->bind($configuration[0], $configuration[1]);
        }
    }
}
