<?php

namespace Jhoff\BladeVue\Testing\Unit;

use Jhoff\BladeVue\Element;
use Jhoff\BladeVue\Directives\Basic;
use Jhoff\BladeVue\Testing\TestCase;
use Jhoff\BladeVue\Directives\Inline;

class VueDirectiveTest extends TestCase
{
    /**
     * @test
     */
    public function basicStartDirectiveReturnsCorrectPhpBlock()
    {
        $code = Basic::start('"component", ["foo" => "bar"]');

        $this->assertEquals(
            '<?php echo \Jhoff\BladeVue\Components\Basic::start("component", ["foo" => "bar"]); ?><div>',
            $code
        );
    }

    /**
     * @test
     */
    public function basicEndDirectiveReturnsCorrectPhpBlock()
    {
        $code = Basic::end();

        $this->assertEquals(
            '</div><?php echo \Jhoff\BladeVue\Components\Basic::end(); ?>',
            $code
        );
    }

    /**
     * @test
     */
    public function inlineStartDirectiveReturnsCorrectPhpBlock()
    {
        $code = Inline::start('"component", ["foo" => "bar"]');

        $this->assertEquals(
            '<?php echo \Jhoff\BladeVue\Components\Inline::start("component", ["foo" => "bar"]); ?><div>',
            $code
        );
    }

    /**
     * @test
     */
    public function inlineEndDirectiveReturnsCorrectPhpBlock()
    {
        $code = Inline::end();

        $this->assertEquals(
            '</div><?php echo \Jhoff\BladeVue\Components\Inline::end(); ?>',
            $code
        );
    }
}
