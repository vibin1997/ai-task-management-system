@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-10">

    <h1 class="text-5xl font-bold">
        Task List
    </h1>

    <a href="{{ route('tasks.create') }}"
       class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-xl font-semibold">
        + New Task
    </a>

</div>

<form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10">

    <input
        type="text"
        name="search"
        placeholder="Search Task"
        class="rounded-xl border-none text-black"
    >

    <select name="status" class="rounded-xl text-black">
        <option value="">Status</option>
        <option value="pending">Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="completed">Completed</option>
    </select>

    <select name="priority" class="rounded-xl text-black">
        <option value="">Priority</option>
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
    </select>

    <button class="bg-blue-500 rounded-xl px-4 py-2">
        Filter
    </button>

</form>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @foreach($tasks as $task)

    <div class="bg-white rounded-3xl p-6 text-black shadow-xl">

        <div class="flex justify-between mb-4">

            <span class="bg-gray-100 text-sm px-3 py-1 rounded-full">
                {{ ucfirst($task->status) }}
            </span>

            <span class="text-gray-400">•••</span>

        </div>

        <h2 class="text-2xl font-bold mb-4">
            {{ $task->title }}
        </h2>

        <div class="flex gap-2 mb-4">

            <span class="bg-red-100 text-red-500 px-3 py-1 rounded-full text-sm">
                {{ ucfirst($task->priority) }}
            </span>

        </div>

        <p class="text-gray-600 mb-4">
            {{ Str::limit($task->description, 100) }}
        </p>

        <div class="text-sm text-gray-500 mb-5">
            Due: {{ $task->due_date }}
        </div>

        <div class="flex gap-3 justify-end">

            <a href="{{ route('tasks.edit', $task->id) }}"
               class="bg-gray-200 px-4 py-2 rounded-xl">
                Edit
            </a>

            <a href="{{ route('tasks.show', $task->id) }}"
               class="bg-blue-500 text-white px-4 py-2 rounded-xl">
                View
            </a>

        </div>

    </div>

    @endforeach

</div>

<div class="mt-10">
    {{ $tasks->links() }}
</div>

@endsection