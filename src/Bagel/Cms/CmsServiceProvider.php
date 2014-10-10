<?php namespace Bagel\Cms;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('bagel/cms');

        $this->registerExternalDependencies();

        require __DIR__ . '/../../macros.php';
        require __DIR__ . '/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
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

    /**
     * Register our via composer loaded dependencies in the application.
     */

    protected function registerExternalDependencies()
    {
        $this->app->register('Baum\BaumServiceProvider');
        $this->app->register('Laracasts\Commander\CommanderServiceProvider');

        // Change the CommandTranslater to our custom instance (Jeff you rock!)
        $this->app->bind('Laracasts\Commander\CommandTranslator', 'Bagel\Cms\Commander\BagelCommandTranslator');
    }

}
