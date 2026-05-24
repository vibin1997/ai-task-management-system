<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AI Task Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-[#111827] min-h-screen text-white">

<div class="flex min-h-screen">

    <!-- MAIN CONTENT -->

    <main class="flex-1 p-10">

        <!-- HEADER -->

        <div class="flex justify-between items-center mb-10">

            <div>

                <h1 class="text-5xl font-bold mb-2">

                    @yield('page-title')

                </h1>

                <p class="text-gray-300">

                    AI Assisted Task Management Dashboard

                </p>

            </div>

            <!-- <a href="{{ route('tasks.create') }}"
               class="bg-blue-500 hover:bg-blue-600 transition px-8 py-4 rounded-2xl font-semibold">

                + New Task

            </a> -->

        </div>

        <!-- SUCCESS MESSAGE -->

        @if(session('success'))

            <div class="bg-green-500 px-6 py-4 rounded-2xl mb-8">

                {{ session('success') }}

            </div>

        @endif

        <!-- PAGE CONTENT -->

        @yield('content')

    </main>

    <!-- RIGHT SIDEBAR -->

    <aside class="w-96 bg-white text-black p-6 hidden lg:flex flex-col justify-between">

        <div>

            <!-- PROFILE -->

            <div class="flex items-center gap-4 mb-10">

                <img
                    src="https://i.pravatar.cc/150?img=12"
                    class="w-20 h-20 rounded-full object-cover shadow-lg"
                >

                <div>

                    <h2 class="font-bold text-2xl">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="text-gray-400 text-sm">
                        Admin User
                    </p>

                </div>

            </div>

            <!-- MENU -->

            <nav class="space-y-3 mb-10">

                <a href="{{ route('tasks.index') }}"
                   class="block bg-blue-500 text-white px-5 py-4 rounded-2xl">

                    Tasks

                </a>

                <a href="{{ route('profile.edit') }}"
                   class="block px-5 py-4 rounded-2xl hover:bg-gray-100 transition">

                    Profile

                </a>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="w-full text-left px-5 py-4 rounded-2xl hover:bg-gray-100 transition"
                    >
                        Logout
                    </button>

                </form>

            </nav>

            <!-- STATS -->

    <!-- ROUND TASK STATS -->

            <div class="bg-gray-100 rounded-3xl p-6 mb-8">

                <h2 class="text-xl font-bold mb-6">
                    Task Statistics
                </h2>

                <div class="grid grid-cols-3 gap-4 text-center">

                    <!-- TOTAL -->

                    <div>

                        <div class="relative w-20 h-20 mx-auto mb-3">

                            <svg class="w-20 h-20 rotate-[-90deg]">

                                <circle
                                    cx="40"
                                    cy="40"
                                    r="30"
                                    stroke="#E5E7EB"
                                    stroke-width="8"
                                    fill="none"
                                />

                                <circle
                                    cx="40"
                                    cy="40"
                                    r="30"
                                    stroke="#3B82F6"
                                    stroke-width="8"
                                    fill="none"
                                    stroke-dasharray="188"
                                    stroke-dashoffset="40"
                                    stroke-linecap="round"
                                />

                            </svg>

                            <span class="absolute inset-0 flex items-center justify-center font-bold text-lg">

                                {{ $totalTasks ?? 0 }}

                            </span>

                        </div>

                        <p class="text-sm text-gray-500 font-medium">
                            Total
                        </p>

                    </div>

                    <!-- COMPLETED -->

                    <div>

                        <div class="relative w-20 h-20 mx-auto mb-3">

                            <svg class="w-20 h-20 rotate-[-90deg]">

                                <circle
                                    cx="40"
                                    cy="40"
                                    r="30"
                                    stroke="#E5E7EB"
                                    stroke-width="8"
                                    fill="none"
                                />

                                <circle
                                    cx="40"
                                    cy="40"
                                    r="30"
                                    stroke="#10B981"
                                    stroke-width="8"
                                    fill="none"
                                    stroke-dasharray="188"
                                    stroke-dashoffset="60"
                                    stroke-linecap="round"
                                />

                            </svg>

                            <span class="absolute inset-0 flex items-center justify-center font-bold text-lg">

                                {{ $completedTasks ?? 0 }}

                            </span>

                        </div>

                        <p class="text-sm text-gray-500 font-medium">
                            Completed
                        </p>

                    </div>

                    <!-- PENDING -->

                    <div>

                        <div class="relative w-20 h-20 mx-auto mb-3">

                            <svg class="w-20 h-20 rotate-[-90deg]">

                                <circle
                                    cx="40"
                                    cy="40"
                                    r="30"
                                    stroke="#E5E7EB"
                                    stroke-width="8"
                                    fill="none"
                                />

                                <circle
                                    cx="40"
                                    cy="40"
                                    r="30"
                                    stroke="#EF4444"
                                    stroke-width="8"
                                    fill="none"
                                    stroke-dasharray="188"
                                    stroke-dashoffset="90"
                                    stroke-linecap="round"
                                />

                            </svg>

                            <span class="absolute inset-0 flex items-center justify-center font-bold text-lg">

                                {{ $pendingTasks ?? 0 }}

                            </span>

                        </div>

                        <p class="text-sm text-gray-500 font-medium">
                            Pending
                        </p>

                    </div>

                </div>

            </div>



        <!-- CHART -->

        <div class="bg-[#111827] rounded-3xl p-6">

            <h2 class="text-2xl font-bold mb-5 text-white">

                Monthly Task Report

            </h2>

            <canvas id="taskChart"></canvas>

        </div>

    </aside>

</div>

<!-- CHART JS -->

<script>

const ctx = document.getElementById('taskChart');

if(ctx){

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: @json($labels ?? []),

            datasets: [{

                label: 'Tasks',

                data: @json($data ?? []),

                borderRadius: 12,

                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#F59E0B',
                    '#EF4444',
                    '#8B5CF6',
                    '#06B6D4'
                ]

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                x: {

                    ticks: {
                        color: '#ffffff'
                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {
                        color: '#ffffff'
                    }

                }

            }

        }

    });

}

</script>

</body>
</html>