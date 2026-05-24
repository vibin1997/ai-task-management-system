<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $repo,
        protected AIService $aiService
    ) {}

    public function getAll(array $filters = [])
    {
        return $this->repo->all($filters);
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $task = $this->repo->create($data);

            $aiData = $this->aiService
                ->generateSummary($task);

            $this->repo->update($task->id, $aiData);

            return $this->repo->find($task->id);
        });
    }

    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }


}