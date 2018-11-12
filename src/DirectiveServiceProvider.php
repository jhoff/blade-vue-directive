<?php

namespace Jhoff\BladeVue;

use Jhoff\BladeVue\Directives\Basic;
use Illuminate\Support\Facades\Blade;
use Jhoff\BladeVue\Directives\Inline;
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
            return Basic::start($expression);
        });

        Blade::directive('endvue', function () {
            return Basic::end();
        });

        Blade::directive('inlinevue', function ($expression) {
            return Inline::start($expression);
        });

        Blade::directive('endinlinevue', function () {
            return Inline::end();
        });
    }
}
