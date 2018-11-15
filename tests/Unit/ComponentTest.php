<?php

namespace Jhoff\BladeVue\Testing\Unit;

use Exception;
use TypeError;
use Jhoff\BladeVue\Components\Basic;
use Jhoff\BladeVue\Testing\TestCase;
use Jhoff\BladeVue\Components\Inline;

class ComponentTest extends TestCase
{
    /**
     * @test
     */
    public function basicComponentRendersStartTag()
    {
        $tag = Basic::start('foobar');

        $this->assertRegExp('/\<component.*\>/', $tag);
        $this->assertRegExp('/[\s\>]v-cloak[\s\>]/', $tag);
        $this->assertRegExp('/[\s\>]is="foobar"[\s\>]/', $tag);
    }

    /**
     * @test
     */
    public function inlineComponentRendersStartTag()
    {
        $tag = Inline::start('foobar');

        $this->assertRegExp('/\<component.*\>/', $tag);
        $this->assertRegExp('/[\s\>]inline-template[\s\>]/', $tag);
        $this->assertRegExp('/[\s\>]v-cloak[\s\>]/', $tag);
        $this->assertRegExp('/[\s\>]is="foobar"[\s\>]/', $tag);
    }

    /**
     * @test
     */
    public function basicComponentRendersEndTag()
    {
        $tag = Basic::end();

        $this->assertEquals('</component>', $tag);
    }

    /**
     * @test
     */
    public function tooManyArgumentsThrowsException()
    {
        try {
            Basic::start('foobar', [], 'this is invalid');
        } catch (Exception $exception) {
            $this->assertEquals('Too many arguments passed to vue directive', $exception->getMessage());
            return;
        }

        $this->fail('Failed to throw exception with too many arguments');
    }

    /**
     * @test
     */
    public function nonArraySecondArgumentThrowsTypeError()
    {
        try {
            Basic::start('foobar', 'this is invalid');
        } catch (TypeError $typeError) {
            $this->assertContains('::start() must be of the type array', $typeError->getMessage());
            return;
        }

        $this->fail('Failed to throw type error with non array second argument');
    }

    /**
     * @test
     */
    public function nonAssociativeArraySecondArgumentThrowsException()
    {
        try {
            Basic::start('foobar', [1, 2, 3]);
        } catch (Exception $exception) {
            $this->assertEquals(
                'Second argument for vue directive must be an associtive array',
                $exception->getMessage()
            );
            return;
        }

        $this->fail('Failed to throw exception with non associtive array second argument');
    }

    /**
     * @test
     */
    public function componentWithBooleanArgumentsRendersStartTag()
    {
        $tag = Basic::start('foobar', ['foo' => true, 'baz' => false]);

        $this->assertRegExp('/[\s\>]:foo="true"[\s\>]/', $tag);
        $this->assertRegExp('/[\s\>]:baz="false"[\s\>]/', $tag);
    }

    /**
     * @test
     */
    public function componentWithScalarArgumentsRendersStartTag()
    {
        $tag = Basic::start('foobar', ['foo' => 'bar', 'baz' => 123]);

        $this->assertRegExp('/[\s\>]foo="bar"[\s\>]/', $tag);
        $this->assertRegExp('/[\s\>]:baz="123"[\s\>]/', $tag);
    }

    /**
     * @test
     */
    public function componentWithArrayOrObjectArgumentsRendersStartTag()
    {
        $tag = Basic::start(
            'foobar',
            [
                'foo' => [1, 2, 3],
                'bar' => (object) ['foo' => 'bar'],
                'baz' => ['baz' => 'qux']
            ]
        );

        $this->assertRegExp('/[\s\>]:foo="\[1,2,3\]"[\s\>]/', $tag);
        $this->assertRegExp('/[\s\>]:bar="{&quot;foo&quot;:&quot;bar&quot;}"[\s\>]/', $tag);
        $this->assertRegExp('/[\s\>]:baz="{&quot;baz&quot;:&quot;qux&quot;}"[\s\>]/', $tag);
    }
}
