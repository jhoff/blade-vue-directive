<?php

namespace Jhoff\BladeVue\Testing;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Jhoff\BladeVue\DirectiveServiceProvider'];
    }
}
