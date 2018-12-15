<?php

namespace Modules\Thongke\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Thongke\Events\Handlers\RegisterThongkeSidebar;

class ThongkeServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterThongkeSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('thongkedays', array_dot(trans('thongke::thongkedays')));
            $event->load('thongketimes', array_dot(trans('thongke::thongketimes')));
            $event->load('thongkehotels', array_dot(trans('thongke::thongkehotels')));
            $event->load('thongketourguides', array_dot(trans('thongke::thongketourguides')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('thongke', 'permissions');

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
            'Modules\Thongke\Repositories\ThongkedayRepository',
            function () {
                $repository = new \Modules\Thongke\Repositories\Eloquent\EloquentThongkedayRepository(new \Modules\Thongke\Entities\Thongkeday());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Thongke\Repositories\Cache\CacheThongkedayDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Thongke\Repositories\ThongketimeRepository',
            function () {
                $repository = new \Modules\Thongke\Repositories\Eloquent\EloquentThongketimeRepository(new \Modules\Thongke\Entities\Thongketime());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Thongke\Repositories\Cache\CacheThongketimeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Thongke\Repositories\ThongkehotelRepository',
            function () {
                $repository = new \Modules\Thongke\Repositories\Eloquent\EloquentThongkehotelRepository(new \Modules\Thongke\Entities\Thongkehotel());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Thongke\Repositories\Cache\CacheThongkehotelDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Thongke\Repositories\ThongketourguideRepository',
            function () {
                $repository = new \Modules\Thongke\Repositories\Eloquent\EloquentThongketourguideRepository(new \Modules\Thongke\Entities\Thongketourguide());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Thongke\Repositories\Cache\CacheThongketourguideDecorator($repository);
            }
        );
// add bindings




    }
}
