<?php

namespace App\Helpers;

/**
 * Gets an associated array from the Status object.
 *
 * @param  object  $statuses
 * @return array $statusesArray
 */
function getArray($collection)
{
    $objectsArray = $collection->mapWithKeys(function ($object) {
        return [$object->id => $object->name];
    });
    return $objectsArray;
}
