<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Contracts
use App\Contracts\Services\AuthServiceInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\AuthProviderInterface;
// Services
use App\Services\AuthService;
use App\Infraestructure\Auth\SanctumProvider;

// Repositories
use App\Infraestructure\Repositories\Eloquent\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthProviderInterface::class, SanctumProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
