<?php

namespace Jhoff\BladeVue\Testing\Unit;

use Jhoff\BladeVue\Element;
use Jhoff\BladeVue\Testing\TestCase;

class ElementTest extends TestCase
{
    /**
     * @test
     */
    public function newElementSetsTagName()
    {
        $element = new Element('newTag');

        $this->assertEquals('<newTag>', $element->getStartTag());
        $this->assertEquals('</newTag>', $element->getEndTag());
    }

    /**
     * @test
     */
    public function newElementAddsBooleanAttributes()
    {
        $element = (new Element('newTag'))
            ->setAttribute('foobar', null);

        $this->assertEquals('<newTag foobar>', $element->getStartTag());
    }

    /**
     * @test
     */
    public function newElementAddsValueAttributes()
    {
        $element = (new Element('newTag'))
            ->setAttribute('foobar', 'bazqux');

        $this->assertEquals('<newTag foobar="bazqux">', $element->getStartTag());
    }
}
