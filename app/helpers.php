<?php

namespace App\Helpers;

/**
 * Gets an associated array from the Status object.
 *
 * @param  object  $collection
 * @return array $objectsArray
 */
function getArray($collection)
{
    $objectsArray = $collection->mapWithKeys(function ($object) {
        return [$object->id => $object->name];
    });
    return $objectsArray;
}
