<?php

if (!function_exists('parsedown')) {
    /**
     * convert markdown to html.
     *
     * @author
     *
     * @param string $expression
     *
     * @return string
     */
    function parsedown($expression)
    {
        return app('parsedown')->text($expression);
    }
}