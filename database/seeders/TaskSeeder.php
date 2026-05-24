<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Task::create([
            'title' => 'Launch New Marketing Campaign',
            'description' => 'Create social media marketing campaign',
            'priority' => 'high',
            'status' => 'in_progress',
            'due_date' => now()->addDays(10),
            'assigned_to' => $user->id,
            'ai_summary' => 'Marketing campaign planning task',
            'ai_priority' => 'high'
        ]);
    }
}