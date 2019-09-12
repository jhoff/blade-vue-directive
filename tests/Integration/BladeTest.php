<?php

namespace Jhoff\BladeVue\Testing\Integration;

use Jhoff\BladeVue\Testing\TestCase;

class BladeTest extends TestCase
{
    /**
     * @test
     */
    public function bladeRendersBasicVueDirective()
    {
        $output = $this->renderBasicBlade('"my-component"');

        $this->assertStringContainsString('<component', $output);
        $this->assertStringContainsString('is="my-component"', $output);
        $this->assertStringContainsString('</component>', $output);
    }

    /**
     * @test
     */
    public function bladeRendersAdvancedVueDirective()
    {
        $output = $this->renderBasicBlade('"my-component", ["foo" => "bar"]');

        $this->assertStringContainsString('<component', $output);
        $this->assertStringContainsString('is="my-component"', $output);
        $this->assertStringContainsString('foo="bar"', $output);
        $this->assertStringContainsString('</component>', $output);
    }
    /**
     * @test
     */
    public function bladeRendersInlineVueDirective()
    {
        $output = $this->renderInlineBlade('"my-component"');

        $this->assertStringContainsString('<component', $output);
        $this->assertStringContainsString('inline-template', $output);
        $this->assertStringContainsString('is="my-component"', $output);
        $this->assertStringContainsString('</component>', $output);
    }

    /**
     * @test
     */
    public function bladeRendersAdvancedInlineVueDirective()
    {
        $output = $this->renderInlineBlade('"my-component", ["foo" => "bar"]');

        $this->assertStringContainsString('<component', $output);
        $this->assertStringContainsString('inline-template', $output);
        $this->assertStringContainsString('is="my-component"', $output);
        $this->assertStringContainsString('foo="bar"', $output);
        $this->assertStringContainsString('</component>', $output);
    }

    /**
     * Creates a vue file in the testbench views directory and renders it
     *
     * @param string $expression
     * @return string
     */
    protected function renderBasicBlade(string $expression)
    {
        @file_put_contents(
            resource_path('views/vue.blade.php'),
            "@vue($expression)\n<div>Testing</div>\n@endvue"
        );

        return view()->make('vue')->render();
    }

    /**
     * Creates a vue file in the testbench views directory and renders it
     *
     * @param string $expression
     * @return string
     */
    protected function renderInlineBlade(string $expression)
    {
        @file_put_contents(
            resource_path('views/vue.blade.php'),
            "@inlinevue($expression)\n<div>Testing</div>\n@endinlinevue"
        );

        return view()->make('vue')->render();
    }
}
