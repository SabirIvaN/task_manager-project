<?php

namespace App\Policies;

use Auth;
use App\Label;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Label $label)
    {
        return true;
    }

    public function create(?User $user)
    {
        return true;
    }

    public function update(User $user)
    {
        return true;
    }

    public function delete(User $user, Label $label)
    {
        return true;
    }

    public function restore(User $user, Label $label)
    {
        return true;
    }

    public function forceDelete(User $user, Label $label)
    {
        return false;
    }
}
