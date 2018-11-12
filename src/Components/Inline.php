<?php

namespace Jhoff\BladeVue\Components;

use Jhoff\BladeVue\Components\Component;

class Inline extends Component
{
    /**
     * Default attributes to apply to the component
     *
     * @var array
     */
    protected static $defaultAttributes = [
        'inline-template',
        'v-cloak',
    ];
}
