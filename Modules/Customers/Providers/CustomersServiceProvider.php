<?php

namespace Modules\Customers\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Customers\Events\Handlers\RegisterCustomersSidebar;

class CustomersServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterCustomersSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('customers', array_dot(trans('customers::customers')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('customers', 'permissions');

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
            'Modules\Customers\Repositories\CustomerRepository',
            function () {
                $repository = new \Modules\Customers\Repositories\Eloquent\EloquentCustomerRepository(new \Modules\Customers\Entities\Customer());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Customers\Repositories\Cache\CacheCustomerDecorator($repository);
            }
        );
// add bindings

    }
}
