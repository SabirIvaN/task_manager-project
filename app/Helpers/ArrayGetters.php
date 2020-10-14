<?php

namespace App\Helpers\ArrayGetters;

/**
 * Gets an associated array from the Status object.
 *
 * @param  object  $statuses
 * @return array $statusesArray
 */
function getStatus($statuses)
{
    $statusesArray = $statuses->mapWithKeys(function ($status) {
        return [$status->id => $status->name];
    });
    return $statusesArray;
}

/**
 * Gets an associated array from the User object.
 *
 * @param  object  $users
 * @return array $usersArray
 */
function getUsers($users)
{
    $usersArray = $users->mapWithKeys(function ($user) {
        return [$user->id => $user->name];
    });
    return $usersArray;
}

/**
 * Gets an associated array from the object.
 *
 * @param  object  $labels
 * @return array $labelsArray
 */
function getLabels($labels)
{
    $labelsArray = $labels->mapWithKeys(function ($label) {
        return [$label->id => $label->name];
    });
    return $labelsArray;
}
