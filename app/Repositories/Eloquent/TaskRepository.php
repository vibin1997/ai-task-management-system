<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(array $filters = [])
    {
        return Task::query()
            ->with('user')
            ->filter($filters)
            ->latest()
            ->paginate(10);
    }

    public function find(int $id)
    {
        return Task::with('user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    // public function update(int $id, array $data)
    // {
    //     $task = Task::findOrFail($id);

    //     return $task->update($data);
        
    // }

    public function update(int $id, array $data)
{
    $task = Task::findOrFail($id);

    $task->update($data);

    return $task->fresh();
}

    public function delete(int $id)
    {
        return Task::destroy($id);
    }

    
}