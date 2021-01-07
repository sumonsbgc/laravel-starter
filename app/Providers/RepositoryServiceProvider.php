<?php

namespace App\Providers;

use App\Contracts\AttributeContract;
use App\Contracts\AttributeValueContract;
use App\Contracts\BrandContract;
use App\Contracts\UserContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use App\Repositories\BrandRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [
        UserContract::class      => UserRepository::class,
        CategoryContract ::class => CategoryRepository ::class,
        AttributeContract::class => AttributeRepository::class,
        AttributeValueContract::class => AttributeValueRepository::class,
        BrandContract::class => BrandRepository::class,
        ProductContract::class => ProductRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */    
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
