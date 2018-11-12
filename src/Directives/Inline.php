<?php

namespace Jhoff\BladeVue\Directives;

class Inline
{
    /**
     * Php code required to render the ending component html tag
     *
     * @return string
     */
    public static function end() : string
    {
        return '</div><?php echo \Jhoff\BladeVue\Components\Inline::end(); ?>';
    }

    /**
     * Php code required to parse the expression and render the starting component html tag
     *
     * @param string $expression
     * @return string
     */
    public static function start(string $expression) : string
    {
        return "<?php echo \Jhoff\BladeVue\Components\Inline::start($expression); ?><div>";
    }
}
