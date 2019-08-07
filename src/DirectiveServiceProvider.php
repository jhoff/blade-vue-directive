<?php

namespace Jhoff\BladeVue;

use Jhoff\BladeVue\Directives\Basic;
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
        app('view');

        app('blade.compiler')->directive('vue', function ($expression) {
            return Basic::start($expression);
        });

        app('blade.compiler')->directive('endvue', function () {
            return Basic::end();
        });

        app('blade.compiler')->directive('inlinevue', function ($expression) {
            return Inline::start($expression);
        });

        app('blade.compiler')->directive('endinlinevue', function () {
            return Inline::end();
        });
    }
}
