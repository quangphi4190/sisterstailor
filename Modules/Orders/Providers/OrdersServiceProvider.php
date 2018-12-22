<?php

namespace Modules\Orders\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Orders\Events\Handlers\RegisterOrdersSidebar;

class OrdersServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterOrdersSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('orders', array_dot(trans('orders::orders')));
            $event->load('order_details', array_dot(trans('orders::order_details')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('orders', 'permissions');

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
            'Modules\Orders\Repositories\OrderRepository',
            function () {
                $repository = new \Modules\Orders\Repositories\Eloquent\EloquentOrderRepository(new \Modules\Orders\Entities\Order());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Orders\Repositories\Cache\CacheOrderDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Orders\Repositories\Order_detailsRepository',
            function () {
                $repository = new \Modules\Orders\Repositories\Eloquent\EloquentOrder_detailsRepository(new \Modules\Orders\Entities\Order_details());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Orders\Repositories\Cache\CacheOrder_detailsDecorator($repository);
            }
        );
// add bindings


    }
}
