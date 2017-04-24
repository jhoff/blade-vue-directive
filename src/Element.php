<?php

namespace Jhoff\BladeVue;

class Element
{
    /**
     * Element tag name
     *
     * @var string
     */
    protected $name;

    /**
     * Element attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Instantiate a new element
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Gets the ending tag for the element
     *
     * @return string
     */
    public function getEndTag() : string
    {
        return "</{$this->name}>";
    }

    /**
     * Gets the starting tag for the element
     *
     * @return string
     */
    public function getStartTag() : string
    {
        $attributes = $this->renderAttributes();

        return "<{$this->name}" . ( $attributes ? ' ' . $attributes : '' ) . '>';
    }

    /**
     * Sets the attribute on the element
     *
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setAttribute(string $name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Builds an attribute string
     *
     * @param string $key
     * @param mixed $value
     * @return string
     */
    protected function buildAttribute(string $key, $value) : string
    {
        return is_null($value) ? $key : sprintf('%s="%s"', $key, $value);
    }

    /**
     * Renders all of the attributes in the proper format
     *
     * @return string
     */
    protected function renderAttributes() : string
    {
        return implode(' ', array_map(
            [$this, 'buildAttribute'],
            array_keys($this->attributes),
            $this->attributes
        ));
    }
}
