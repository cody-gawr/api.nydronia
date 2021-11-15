<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\{
    TokenContract
};
use App\Services\{
    TokenService
};

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->singleton(TokenContract::class, TokenService::class);
    }
}
