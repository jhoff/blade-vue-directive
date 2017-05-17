<?php

namespace Jhoff\BladeVue\Testing\Unit;

use Jhoff\BladeVue\Element;
use Jhoff\BladeVue\VueDirective;
use Jhoff\BladeVue\Testing\TestCase;

class VueDirectiveTest extends TestCase
{
    /**
     * @test
     */
    public function startDirectiveReturnsCorrectPhpBlock()
    {
        $code = VueDirective::start('"component", ["foo" => "bar"]');

        $this->assertEquals(
            '<?php echo \Jhoff\BladeVue\Component::start("component", ["foo" => "bar"]); ?><div>',
            $code
        );
    }

    /**
     * @test
     */
    public function endDirectiveReturnsCorrectPhpBlock()
    {
        $code = VueDirective::end();

        $this->assertEquals(
            '</div><?php echo \Jhoff\BladeVue\Component::end(); ?>',
            $code
        );
    }
}
