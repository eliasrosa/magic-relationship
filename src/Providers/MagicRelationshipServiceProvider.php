<?php

namespace Magic\Providers;

use Illuminate\Routing\Router;
use BW\Router\Router as BwRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class MagicRelationshipServiceProvider extends ServiceProvider
{
    //
    public function boot(Router $router)
    {
        //
        parent::boot($router);

        //
        $this->publishes([__DIR__ . '/../../config.php' => config_path('/magic.php')], 'config');
        $this->publishes([__DIR__ . '/../../public' => public_path('packages/eliasrosa/magic-relationship')], 'public');
        $this->publishes([__DIR__ . '/../../database/migrations' => database_path('migrations')], 'migrations');
    }

    //
    public function register()
    {
        //
        \View::addNamespace('Magic', __DIR__ . '/../../views');
    }

    //
    public function map(Router $router)
    {
        $router->group(BwRouter::getParameters('default'), function (Router $router) {
            require __DIR__ . '/../../routes.php';
        });
    }

}
