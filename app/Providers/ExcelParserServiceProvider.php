<?php

namespace App\Providers;

use App\Helpers\ExcelParser;
use Illuminate\Support\ServiceProvider;

class ExcelParserServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ExcelParser::class, function ($app) {
            return new ExcelParser(\Auth::user()->id);
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //return ['App\Helpers\ExcelInterface'];
        return [ExcelParser::class];
    }

}
