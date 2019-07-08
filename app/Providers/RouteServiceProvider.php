<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers\Web';
    protected $apiControllers = 'App\Http\Controllers\Api';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

    }


    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }


    protected function mapApiRoutes()
    {
        foreach (glob(base_path('routes/api/*.php')) as $routeFile) {
            $filePrefix = basename($routeFile, ".php");
            Route::group([
                'prefix'     => "api/v1/{$filePrefix}",
                'namespace'  => $this->apiControllers,
                'middleware' => ['api'],
            ], $routeFile);
        }
    }
}
