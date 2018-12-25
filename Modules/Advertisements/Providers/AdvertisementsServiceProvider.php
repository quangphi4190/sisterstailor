<?php

namespace Modules\Advertisements\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Advertisements\Events\Handlers\RegisterAdvertisementsSidebar;

class AdvertisementsServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterAdvertisementsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('advertisements', array_dot(trans('advertisements::advertisements')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('advertisements', 'permissions');

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
            'Modules\Advertisements\Repositories\AdvertisementRepository',
            function () {
                $repository = new \Modules\Advertisements\Repositories\Eloquent\EloquentAdvertisementRepository(new \Modules\Advertisements\Entities\Advertisement());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Advertisements\Repositories\Cache\CacheAdvertisementDecorator($repository);
            }
        );
// add bindings

    }
}
