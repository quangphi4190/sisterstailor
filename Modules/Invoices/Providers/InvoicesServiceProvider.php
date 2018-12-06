<?php

namespace Modules\Invoices\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Invoices\Events\Handlers\RegisterInvoicesSidebar;

class InvoicesServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterInvoicesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('invoices', array_dot(trans('invoices::invoices')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('invoices', 'permissions');

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
            'Modules\Invoices\Repositories\InvoiceRepository',
            function () {
                $repository = new \Modules\Invoices\Repositories\Eloquent\EloquentInvoiceRepository(new \Modules\Invoices\Entities\Invoice());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Invoices\Repositories\Cache\CacheInvoiceDecorator($repository);
            }
        );
// add bindings

    }
}
