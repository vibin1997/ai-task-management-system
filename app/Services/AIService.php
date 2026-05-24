<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class AIService
{
    public function generateSummary(Task $task): array
    {
        try {

            $prompt = $this->buildPrompt($task);

            // OpenAI or Gemini Integration Here

            return [
                'ai_summary' => 'AI generated summary for task: '.$task->title,
                'ai_priority' => 'high'
            ];

        } catch (\Throwable $e) {

            Log::error($e->getMessage());

            return [
                'ai_summary' => 'Fallback AI summary',
                'ai_priority' => $task->priority
            ];
        }
    }

    protected function buildPrompt(Task $task): string
    {
        return "
            Analyze this task.

            Return:
            1. Short summary
            2. Suggested priority

            Title: {$task->title}
            Description: {$task->description}
        ";
    }
}