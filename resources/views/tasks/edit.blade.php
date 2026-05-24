@extends('layouts.app')

@section('content')

<h1 class="text-5xl font-bold mb-10">
    Edit Task
</h1>

{{-- VALIDATION ERRORS --}}

@if ($errors->any())

    <div class="bg-red-500 text-white p-4 rounded-2xl mb-6">

        <ul class="space-y-1">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

{{-- EDIT FORM --}}

<form
    action="{{ route('tasks.update', $task->id) }}"
    method="POST"
    class="bg-white text-black rounded-3xl p-10 max-w-4xl shadow-xl"
>

    @csrf
    @method('PUT')

    {{-- TITLE --}}

    <div class="mb-6">

        <label class="font-semibold block mb-2">
            Title
        </label>

        <input
            type="text"
            name="title"
            value="{{ old('title', $task->title) }}"
            placeholder="Enter Task Title"
            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

    </div>

    {{-- DESCRIPTION --}}

    <div class="mb-6">

        <label class="font-semibold block mb-2">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            placeholder="Enter Task Description"
            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >{{ old('description', $task->description) }}</textarea>

    </div>

    {{-- PRIORITY + STATUS --}}

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">

        {{-- PRIORITY --}}

        <div>

            <h3 class="text-2xl font-bold mb-5">
                Priority
            </h3>

            <div class="flex gap-3 flex-wrap">

                {{-- LOW --}}

                <label>

                    <input
                        type="radio"
                        name="priority"
                        value="low"
                        class="hidden peer"
                        {{ old('priority', $task->priority) == 'low' ? 'checked' : '' }}
                    >

                    <div class="px-8 py-3 rounded-2xl bg-gray-100 border cursor-pointer font-semibold transition peer-checked:bg-blue-500 peer-checked:text-white">

                        Low

                    </div>

                </label>

                {{-- MEDIUM --}}

                <label>

                    <input
                        type="radio"
                        name="priority"
                        value="medium"
                        class="hidden peer"
                        {{ old('priority', $task->priority) == 'medium' ? 'checked' : '' }}
                    >

                    <div class="px-8 py-3 rounded-2xl bg-gray-100 border cursor-pointer font-semibold transition peer-checked:bg-orange-400 peer-checked:text-white">

                        Medium

                    </div>

                </label>

                {{-- HIGH --}}

                <label>

                    <input
                        type="radio"
                        name="priority"
                        value="high"
                        class="hidden peer"
                        {{ old('priority', $task->priority) == 'high' ? 'checked' : '' }}
                    >

                    <div class="px-8 py-3 rounded-2xl bg-gray-100 border cursor-pointer font-semibold transition peer-checked:bg-red-500 peer-checked:text-white">

                        High

                    </div>

                </label>

            </div>

        </div>

        {{-- STATUS --}}

        <div>

            <label class="font-semibold block mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

                <option value="pending"
                    {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="in_progress"
                    {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="completed"
                    {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

        </div>

    </div>

    {{-- DUE DATE --}}

    <div class="mb-6">

        <label class="block font-semibold mb-2">
            Due Date
        </label>

        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

    </div>

    {{-- ASSIGN USER --}}

    <div class="mb-8">

        <label class="block font-semibold mb-2">
            Assign User
        </label>

        <select
            name="assigned_to"
            class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

            <option value="">
                Select User
            </option>

            @foreach($users as $user)

                <option
                    value="{{ $user->id }}"
                    {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}
                >
                    {{ $user->name }}
                </option>

            @endforeach

        </select>

    </div>

    {{-- SUBMIT BUTTON --}}

    <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-4 rounded-full font-bold text-lg shadow-lg transition"
    >

        Update Task

    </button>

</form>

@endsection