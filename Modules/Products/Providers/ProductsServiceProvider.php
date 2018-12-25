<?php

namespace Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Products\Events\Handlers\RegisterProductsSidebar;

class ProductsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterProductsSidebar::class);

    }

    public function boot()
    {
        $this->publishConfig('products', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Products\Repositories\ProductsRepository',
            function () {
                $repository = new \Modules\Products\Repositories\Eloquent\EloquentProductsRepository(new \Modules\Products\Entities\Products());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Products\Repositories\Cache\CacheProductsDecorator($repository);
            }
        );

// add bindings


    }
}
