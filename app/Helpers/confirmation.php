<?php

/**
 * user confirmation
 *
 * @return true\false
 */
function confirmation()
{
    if (Auth::user()) {
        if (Auth::user()->hasVerifiedEmail()) {
            return true;
        }
    }
    return false;
}
