<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Task::count(),
            'completed' => Task::where('status', 'completed')->count(),
            'pending' => Task::where('status', 'pending')->count(),
            'high_priority' => Task::where('priority', 'high')->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}