<?php

namespace Modules\Post\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Post\Events\Handlers\RegisterPostSidebar;

class PostServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterPostSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('postcategories', array_dot(trans('post::postcategories')));
            $event->load('managecategorys', array_dot(trans('post::managecategorys')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('post', 'permissions');

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
            'Modules\Post\Repositories\PostcategoryRepository',
            function () {
                $repository = new \Modules\Post\Repositories\Eloquent\EloquentPostcategoryRepository(new \Modules\Post\Entities\Postcategory());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Post\Repositories\Cache\CachePostcategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Post\Repositories\ManagecategorysRepository',
            function () {
                $repository = new \Modules\Post\Repositories\Eloquent\EloquentManagecategorysRepository(new \Modules\Post\Entities\Managecategorys());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Post\Repositories\Cache\CacheManagecategorysDecorator($repository);
            }
        );
// add bindings


    }
}
