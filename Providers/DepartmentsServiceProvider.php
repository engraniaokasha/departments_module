<?php

namespace Modules\Departments\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Departments\Events\Handlers\RegisterDepartmentsSidebar;

class DepartmentsServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterDepartmentsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('departments', array_dot(trans('departments::departments')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('departments', 'permissions');

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
            'Modules\Departments\Repositories\DepartmentsRepository',
            function () {
                $repository = new \Modules\Departments\Repositories\Eloquent\EloquentDepartmentsRepository(new \Modules\Departments\Entities\Departments());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Departments\Repositories\Cache\CacheDepartmentsDecorator($repository);
            }
        );
// add bindings

    }
}
