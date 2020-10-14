<?php

namespace App\Helpers\ArrayGetters;

function getStatus($statuses) {
    $statusesArray = $statuses->mapWithKeys(function ($status) {
        return [$status->id => $status->name];
    });
    return $statusesArray;
}

function getUsers($users) {
    $usersArray = $users->mapWithKeys(function ($user) {
        return [$user->id => $user->name];
    });
    return $usersArray;
}

function getLabels($labels) {
    $labelsArray = $labels->mapWithKeys(function ($label) {
        return [$label->id => $label->name];
    });
    return $labelsArray;
}
