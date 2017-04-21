<?php

namespace Jhoff\BladeVue;

class Directive
{
    public static function open(string $expression)
    {
        dd($expression);
    }

    public static function close()
    {
        dd('close');
    }
}
