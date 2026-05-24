@extends('layouts.app')

@section('content')

<h1 class="text-5xl font-bold mb-10">
    Task Detail + AI Summary
</h1>

<div class="bg-white rounded-3xl p-10 text-black max-w-5xl">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-4xl font-bold">
            {{ $task->title }}
        </h2>

        <span class="text-gray-400">•••</span>

    </div>

    <div class="flex gap-4 mb-8">

        <span class="bg-gray-100 px-4 py-2 rounded-full">
            {{ ucfirst($task->status) }}
        </span>

        <span class="bg-red-100 text-red-500 px-4 py-2 rounded-full">
            {{ ucfirst($task->priority) }}
        </span>

    </div>

    <div class="bg-gray-100 rounded-2xl p-6 mb-8">

        <h3 class="text-2xl font-semibold mb-4">
            Description
        </h3>

        <p class="mb-4">
            {{ $task->description }}
        </p>

        <div class="text-gray-500">
            Assigned To: {{ $task->user?->name }}
        </div>

        <div class="text-gray-500 mt-2">
            Due Date: {{ $task->due_date }}
        </div>

    </div>

    <div class="bg-gray-100 rounded-2xl p-6 mb-8">

        <h3 class="text-2xl font-semibold mb-4">
            AI Generated Summary
        </h3>

        <p>
            {{ $task->ai_summary }}
        </p>

    </div>

    <div class="bg-gray-100 rounded-2xl p-6 mb-8">

        <h3 class="text-2xl font-semibold mb-4">
            AI Priority Analysis
        </h3>

        <p>
            {{ ucfirst($task->ai_priority) }}
        </p>

    </div>

</div>

@endsection