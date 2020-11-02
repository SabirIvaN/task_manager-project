<?php

namespace App\Policies;

use Auth;
use App\Status;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Status $status)
    {
        return true;
    }

    public function create(?User $user)
    {
        return true;
    }

    public function update(User $user, Status $status)
    {
        return true;
    }

    public function delete(User $user, Status $status)
    {
        if (!$status->tasks()->exists()) {
            return true;
        }
        return false;
    }

    public function restore(User $user, Status $status)
    {
        return false;
    }

    public function forceDelete(User $user, Status $status)
    {
        return false;
    }
}
