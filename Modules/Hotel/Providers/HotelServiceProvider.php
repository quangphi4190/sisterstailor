<?php

namespace Modules\Hotel\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Hotel\Events\Handlers\RegisterHotelSidebar;

class HotelServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterHotelSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('hotels', array_dot(trans('hotel::hotels')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('hotel', 'permissions');

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
            'Modules\Hotel\Repositories\HotelRepository',
            function () {
                $repository = new \Modules\Hotel\Repositories\Eloquent\EloquentHotelRepository(new \Modules\Hotel\Entities\Hotel());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Hotel\Repositories\Cache\CacheHotelDecorator($repository);
            }
        );
// add bindings

    }
}
