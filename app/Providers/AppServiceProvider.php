<?php

namespace App\Providers;

use App\Src\Business\Services\Interfaces\IUserService;
use App\Src\Business\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $dependencyInjection = new DependencyInjection($this->app);
        $dependencyInjection->configure();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
