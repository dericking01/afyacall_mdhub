<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'App\Repositories\ZoneRepositoryInterface',
            'App\Repositories\ZoneRepository'
        );
        $this->app->bind(
            'App\Repositories\WardRepositoryInterface',
            'App\Repositories\WardRepository'
        );
        $this->app->bind(
            'App\Repositories\StreetRepositoryInterface',
            'App\Repositories\StreetRepository'
        );
        $this->app->bind(
            'App\Repositories\RegionRepositoryInterface',
            'App\Repositories\RegionRepository'
        );
        $this->app->bind(
            'App\Repositories\DistrictRepositoryInterface',
            'App\Repositories\DistrictRepository'
        );
    }
}
