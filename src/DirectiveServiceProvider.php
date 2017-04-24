<?php

namespace Jhoff\BladeVue;

use Jhoff\BladeVue\VueDirective;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DirectiveServiceProvider extends ServiceProvider
{
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
        Blade::directive('vue', function ($expression) {
            return VueDirective::start($expression);
        });

        Blade::directive('endvue', function () {
            return VueDirective::end();
        });
    }
}
