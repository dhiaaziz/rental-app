<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Contracts
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ProductRentRepositoryInterface;

// Implementations
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Existing product binding
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        // New user binding
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        // New product rent binding
        $this->app->bind(
            ProductRentRepositoryInterface::class,
            ProductRentRepository::class
        );

        // Add more as needed...
    }

    public function boot()
    {
        //
    }
}
