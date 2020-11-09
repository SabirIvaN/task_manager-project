<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Task $task)
    {
        return true;
    }

    public function create(?User $user)
    {
        return true;
    }

    public function update(User $user, Task $task)
    {
        return (bool) $user;
    }

    public function delete(User $user, Task $task)
    {
        return $task->createdBy->is($user);
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
