<?php

namespace App\Policies;

use Auth;
use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Task $task)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Task $task)
    {
        if ((Auth::user()->id === $task->createdBy->id) || (Auth::user()->id === $task->assignedTo->id)) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Task $task)
    {
        if (Auth::user()->id === $task->createdBy->id) {
            return true;
        }
        return false;
    }

    public function restore(User $user, Task $task)
    {
        return false;
    }

    public function forceDelete(User $user, Task $task)
    {
        return false;
    }
}
