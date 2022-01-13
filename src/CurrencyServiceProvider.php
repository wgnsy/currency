<?php
namespace Wgnsy\Currency;


use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\App;
use Illuminate\Console\Scheduling\Schedule;



class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    protected $commands = [
        \Wgnsy\Currency\app\Console\Commands\Install::class,

    ];
    public $routeFilePath = '/routes/currency/currency.php';

    public function boot(Router $router): void
    {
      
         $this->loadViewsFrom(__DIR__.'/resources/views', 'currency');
         $this->loadMigrationsFrom(__DIR__.'/database/migrations');
         $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'currency');
        $this->setupRoutes($this->app->router);
        
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        $this->publishAssets();
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            //$schedule->command('command:command')->everyMinute();
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        
        
        $this->mergeConfigFrom(__DIR__.'/../config/currency.php', 'currency');
        $this->commands($this->commands);
        // Register the service the package provides.
        
        //load helpers
        $this->loadHelpers();
        
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['currency'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/currency.php' => config_path('currency.php'),
        ], 'currency.config');

        // Publishing the views.
        $this->publishes([//todo widoki sie nie laduja
            __DIR__.'/resources/views' => base_path('resources/views/vendor/currency'),
        ], 'currency.views');


        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/currency'),
        ], 'currency.lang');

    }

    public function setupRoutes(Router $router)
    {
        
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;
    
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }

        $this->loadRoutesFrom($routeFilePathInUse);
    }
   
    public function loadHelpers(){
        require_once __DIR__.'/helpers.php';
    }
    public function publishAssets(){
        $smoothcms_assets = [__DIR__.'/public' => public_path('vendor/currency')];
        $this->publishes($smoothcms_assets,'currency.public');
    }

}
