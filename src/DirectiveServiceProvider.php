<?php

namespace Jhoff\BladeVue;

use Jhoff\BladeVue\Directives\Basic;
use Jhoff\BladeVue\Directives\Inline;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

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
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive('vue', function ($expression) {
                return Basic::start($expression);
            });

            $bladeCompiler->directive('endvue', function () {
                return Basic::end();
            });

            $bladeCompiler->directive('inlinevue', function ($expression) {
                return Inline::start($expression);
            });

            $bladeCompiler->directive('endinlinevue', function () {
                return Inline::end();
            });
        });
    }
}
