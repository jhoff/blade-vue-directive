<?php

namespace Jhoff\BladeVue;

class VueDirective
{
    /**
     * Php code required to render the ending component html tag
     *
     * @return string
     */
    public static function end() : string
    {
        return '<?php echo \Jhoff\BladeVue\Component::end(); ?>';
    }

    /**
     * Php code required to parse the expression and render the starting component html tag
     *
     * @param string $expression
     * @return string
     */
    public static function start(string $expression) : string
    {
         return "<?php echo \Jhoff\BladeVue\Component::start($expression); ?>";
    }
}
