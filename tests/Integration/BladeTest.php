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

        $this->assertContains('<component', $output);
        $this->assertContains('is="my-component"', $output);
        $this->assertContains('</component>', $output);
    }

    /**
     * @test
     */
    public function bladeRendersAdvancedVueDirective()
    {
        $output = $this->renderBasicBlade('"my-component", ["foo" => "bar"]');

        $this->assertContains('<component', $output);
        $this->assertContains('is="my-component"', $output);
        $this->assertContains('foo="bar"', $output);
        $this->assertContains('</component>', $output);
    }
    /**
     * @test
     */
    public function bladeRendersInlineVueDirective()
    {
        $output = $this->renderInlineBlade('"my-component"');

        $this->assertContains('<component', $output);
        $this->assertContains('inline-template', $output);
        $this->assertContains('is="my-component"', $output);
        $this->assertContains('</component>', $output);
    }

    /**
     * @test
     */
    public function bladeRendersAdvancedInlineVueDirective()
    {
        $output = $this->renderInlineBlade('"my-component", ["foo" => "bar"]');

        $this->assertContains('<component', $output);
        $this->assertContains('inline-template', $output);
        $this->assertContains('is="my-component"', $output);
        $this->assertContains('foo="bar"', $output);
        $this->assertContains('</component>', $output);
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
