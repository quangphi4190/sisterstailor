<?php

namespace Modules\Tourguide\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Tourguide\Events\Handlers\RegisterTourGuideSidebar;

class TourGuideServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterTourGuideSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('tourguides', array_dot(trans('tourguide::tourguides')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('tourguide', 'permissions');

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
            'Modules\Tourguide\Repositories\TourGuideRepository',
            function () {
                $repository = new \Modules\Tourguide\Repositories\Eloquent\EloquentTourGuideRepository(new \Modules\Tourguide\Entities\TourGuide());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Tourguide\Repositories\Cache\CacheTourGuideDecorator($repository);
            }
        );
// add bindings

    }
}
