<?php

namespace App\Helpers;

class Helper
{
    /**
     * Helpers functionals.
     *
     * @return string
     */
    public static function getActiveClass(string $route): string
    {
        if (request()->is($route) || request()->is($route . '/*')) {
            return 'active';
        }
        return '';
    }
}
