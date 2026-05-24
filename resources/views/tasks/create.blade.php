@extends('layouts.app')

@section('content')

<h1 class="text-5xl font-bold mb-10">
    Create Task
</h1>

<form
    action="{{ route('tasks.store') }}"
    method="POST"
    class="bg-white rounded-3xl p-10 text-black max-w-4xl"
>
    @csrf

    <div class="mb-6">

        <label class="font-semibold block mb-2">
            Title
        </label>

        <input
            type="text"
            name="title"
            class="w-full rounded-xl border-gray-300"
        >

    </div>

    <div class="mb-6">

        <label class="font-semibold block mb-2">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            class="w-full rounded-xl border-gray-300"
        ></textarea>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <div>
            <label class="font-semibold block mb-2">Priority</label>

            <select name="priority" class="w-full rounded-xl border-gray-300">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <div>
            <label class="font-semibold block mb-2">Status</label>

            <select name="status" class="w-full rounded-xl border-gray-300">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div>
            <label class="font-semibold block mb-2">Due Date</label>

            <input
                type="date"
                name="due_date"
                class="w-full rounded-xl border-gray-300"
            >
        </div>

        <div>
            <label class="font-semibold block mb-2">Assign User</label>

            <select name="assigned_to" class="w-full rounded-xl border-gray-300">

                @foreach($users as $user)

                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>

                @endforeach

            </select>
        </div>

    </div>

    <button class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-xl">
        Save Task
    </button>

</form>

@endsection