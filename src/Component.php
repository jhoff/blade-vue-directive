<?php

namespace Jhoff\BladeVue;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Jhoff\BladeVue\Element;

class Component
{
    /**
     * Dom element builder instance
     *
     * @var \Jhoff\BladeVue\Element
     */
    protected $element;

    /**
     * Builds a component element and returns the ending element tag
     *
     * @return string
     */
    public static function end() : string
    {
        return (new static)
            ->getEndTag();
    }

    /**
     * Builds a component element and returns the starting element tag
     *
     * @param string $name
     * @param array $attributes
     * @return string
     */
    public static function start(string $name, array $attributes = []) : string
    {
        if (count(func_get_args()) > 2) {
            throw new Exception('Too many arguments passed to vue directive');
        }

        if (!empty($attributes) && !Arr::isAssoc($attributes)) {
            throw new Exception('Second argument for vue directive must be an associtive array');
        }

        return (new static)
            ->setAttribute('inline-template')
            ->setAttribute('v-cloak')
            ->setAttribute('is', $name)
            ->setAttributes($attributes)
            ->getStartTag();
    }

    /**
     * Instantiates a new component element to build off of
     */
    protected function __construct()
    {
        $this->element = new Element('component');
    }

    /**
     * Gets the end tag from the element
     *
     * @return string
     */
    protected function getEndTag() : string
    {
        return $this->element->getEndTag();
    }

    /**
     * Gets the start tag from the element
     *
     * @return string
     */
    protected function getStartTag() : string
    {
        return $this->element->getStartTag();
    }

    /**
     * Resolves the given attribute to vue component form
     *
     * @param string $name
     * @param mixed $value
     * @return array
     */
    protected function resolveAttributeValue(string $name, $value) : array
    {
        if (is_bool($value)) {
            return [":$name", $value ? 'true' : 'false'];
        }

        if (is_numeric($value)) {
            return [":$name", $value];
        }

        if (!is_scalar($value) && !is_null($value)) {
            return [":$name", htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8', false)];
        }

        return [$name, $value];
    }

    /**
     * Resolve and set an attribute on the element
     *
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    protected function setAttribute(string $name, $value = null)
    {
        list($name, $value) = $this->resolveAttributeValue($name, $value);

        $this->element->setAttribute(Str::kebab($name), $value);

        return $this;
    }

    /**
     * Sets an array of attributes on the element
     *
     * @param array $attributes
     * @return $this
     */
    protected function setAttributes(array $attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }

        return $this;
    }
}
