<?php

namespace App\Helpers;

class Helper
{
    /**
     * Helpers functionals.
     *
     * @return string
     */
    public static function checkRoute(string $route): string
    {
        if (request()->is($route) || request()->is($route . '/*')) {
            return $route;
        }
        return '';
    }
}
