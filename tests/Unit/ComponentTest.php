<?php

namespace Jhoff\BladeVue\Testing\Unit;

use Exception;
use TypeError;
use Jhoff\BladeVue\Component;
use Jhoff\BladeVue\Testing\TestCase;

class ComponentTest extends TestCase
{
    /**
     * @test
     */
    public function basicComponentRendersStartTag()
    {
        $tag = Component::start('foobar');

        $this->assertRegExp('/\<component.*\>/', $tag);
        $this->assertContains('inline-template', $tag);
        $this->assertContains('v-cloak', $tag);
        $this->assertContains('is="foobar"', $tag);
    }

    /**
     * @test
     */
    public function basicComponentRendersEndTag()
    {
        $tag = Component::end();

        $this->assertEquals('</component>', $tag);
    }

    /**
     * @test
     */
    public function tooManyArgumentsThrowsException()
    {
        try {
            Component::start('foobar', [], 'this is invalid');
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
            Component::start('foobar', 'this is invalid');
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
            Component::start('foobar', [1, 2, 3]);
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
        $tag = Component::start('foobar', ['foo' => true, 'baz' => false]);

        $this->assertContains(':foo="true"', $tag);
        $this->assertContains(':baz="false"', $tag);
    }

    /**
     * @test
     */
    public function componentWithScalarArgumentsRendersStartTag()
    {
        $tag = Component::start('foobar', ['foo' => 'bar', 'baz' => 123]);

        $this->assertContains('foo="bar"', $tag);
        $this->assertContains(':baz="123"', $tag);
    }

    /**
     * @test
     */
    public function componentWithArrayOrObjectArgumentsRendersStartTag()
    {
        $tag = Component::start(
            'foobar', [
                'foo' => [1, 2, 3],
                'bar' => (object) ['foo' => 'bar'],
                'baz' => ['baz' => 'qux']
            ]
        );

        $this->assertContains(':foo="[1,2,3]"', $tag);
        $this->assertContains(':bar="{&quot;foo&quot;:&quot;bar&quot;}"', $tag);
        $this->assertContains(':baz="{&quot;baz&quot;:&quot;qux&quot;}"', $tag);
    }
}
