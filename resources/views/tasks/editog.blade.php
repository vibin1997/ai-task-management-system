@extends('layouts.app')

@section('content')

<h1 class="text-5xl font-bold mb-10">
    Edit Task
</h1>

@if ($errors->any())

<div class="bg-red-500 text-white p-4 rounded mb-4">

    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach

</div>

@endif

<form action="{{ route('tasks.update', $task->id) }}"
      method="POST"
      class="bg-white text-black rounded-3xl p-10 max-w-4xl">

    @csrf
    @method('PUT')

    <div class="mb-6">

        <label class="font-semibold block mb-2">
            Title
        </label>

        <input
            type="text"
            name="title"
            value="{{ old('title', $task->title) }}"
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
        >{{ old('description', $task->description) }}</textarea>

    </div>

    <div class="grid grid-cols-2 gap-6 mb-6">

        <!-- <div>

            <label class="font-semibold block mb-2">
                Priority
            </label>

            <select
                name="priority"
                class="w-full rounded-xl border-gray-300"
            >

                <option value="low"
                    {{ $task->priority == 'low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="medium"
                    {{ $task->priority == 'medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="high"
                    {{ $task->priority == 'high' ? 'selected' : '' }}>
                    High
                </option>

            </select>

        </div> -->



                <div>

                    <div class="mb-8">

                        <h3 class="text-2xl font-bold mb-5">
                            Priority
                        </h3>

                        <div class="flex gap-4 flex-wrap">

                            <!-- LOW -->

                            <label>

                                <input
                                    type="radio"
                                    name="priority"
                                    value="low"
                                    class="hidden peer"
                                    {{ $task->priority == 'low' ? 'checked' : '' }}
                                >

                                <div class="px-10 py-4 rounded-2xl bg-gray-100 cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white font-semibold transition">

                                    Low

                                </div>

                            </label>

                            <!-- MEDIUM -->

                            <label>

                                <input
                                    type="radio"
                                    name="priority"
                                    value="medium"
                                    class="hidden peer"
                                    {{ $task->priority == 'medium' ? 'checked' : '' }}
                                >

                                <div class="px-10 py-4 rounded-2xl bg-gray-100 cursor-pointer peer-checked:bg-orange-400 peer-checked:text-white font-semibold transition">

                                    Medium

                                </div>

                            </label>

                            <!-- HIGH -->

                            <label>

                                <input
                                    type="radio"
                                    name="priority"
                                    value="high"
                                    class="hidden peer"
                                    {{ $task->priority == 'high' ? 'checked' : '' }}
                                >

                                <div class="px-10 py-4 rounded-2xl bg-gray-100 cursor-pointer peer-checked:bg-red-500 peer-checked:text-white font-semibold transition">

                                    High

                                </div>

                            </label>

                        </div>

                    </div>

                </div>






        <div>

            <label class="font-semibold block mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full rounded-xl border-gray-300"
            >

                <option value="pending"
                    {{ $task->status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="in_progress"
                    {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="completed"
                    {{ $task->status == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

        </div>

    </div>

            {{-- Assign User --}}
        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Assign User
            </label>

            <select
                name="assigned_to"
                class="w-full border border-gray-300 rounded-xl px-4 py-3"
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
<!-- 
    <button
        type="submit"
        class="bg-blue-500 text-white px-8 py-3 rounded-xl"
    > -->
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-14 py-4 rounded-full text-white font-bold text-lg shadow-xl transition">
        Update Task
    </button>

</form>

@endsection