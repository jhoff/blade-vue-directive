<?php

namespace Jhoff\BladeVue\Components;

use Jhoff\BladeVue\Components\Component;

class Basic extends Component
{
    /**
     * Default attributes to apply to the component
     *
     * @var array
     */
    protected static $defaultAttributes = [
        'v-cloak',
    ];
}
