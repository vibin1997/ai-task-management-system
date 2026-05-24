<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {
        return $user->role === 'admin'
            || $task->assigned_to === $user->id;
    }

    public function view(User $user, Task $task): bool
    {
        return $user->role === 'admin'
            || $task->assigned_to === $user->id;
    }
}