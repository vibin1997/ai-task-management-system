<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\User;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $service
    ) {}

    // public function index(Request $request)
    // {
    //     $tasks = $this->service->getAll($request->all());

    //     return view('tasks.index', compact('tasks'));
    // }



        public function index(Request $request)
    {
        $tasks = $this->service->getAll($request->all());

        /*
        |--------------------------------------------------------------------------
        | CHART DATA
        |--------------------------------------------------------------------------
        */

        $monthlyTasks = Task::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($monthlyTasks as $item) {

            $labels[] = date('M', mktime(0, 0, 0, $item->month, 1));

            $data[] = $item->total;
        }

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'completed')->count();

        $pendingTasks = Task::where('status', 'pending')->count();

        return view('tasks.index', compact(
            'tasks',
            'labels',
            'data',
            'totalTasks',
            'completedTasks',
            'pendingTasks'
        ));
    }







    public function create()
    {
        $users = User::all();

           /*
        |--------------------------------------------------------------------------
        | CHART DATA
        |--------------------------------------------------------------------------
        */

        $monthlyTasks = Task::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($monthlyTasks as $item) {

            $labels[] = date('M', mktime(0, 0, 0, $item->month, 1));

            $data[] = $item->total;
        }

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'completed')->count();

        $pendingTasks = Task::where('status', 'pending')->count();

        return view('tasks.create', compact(
            'users',
            'labels',
            'data',
            'totalTasks',
            'completedTasks',
            'pendingTasks'
        ));

        // return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task Created');
    }

    public function show(int $id)
    {
        $task = $this->service->find($id);



           /*
        |--------------------------------------------------------------------------
        | CHART DATA
        |--------------------------------------------------------------------------
        */

        $monthlyTasks = Task::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($monthlyTasks as $item) {

            $labels[] = date('M', mktime(0, 0, 0, $item->month, 1));

            $data[] = $item->total;
        }

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'completed')->count();

        $pendingTasks = Task::where('status', 'pending')->count();

        return view('tasks.show', compact(
            'task',
            'labels',
            'data',
            'totalTasks',
            'completedTasks',
            'pendingTasks'
        ));


        // return view('tasks.show', compact('task'));
    }

    public function edit(int $id)
    {
        $task = $this->service->find($id);

        $users = User::all();


             /*
        |--------------------------------------------------------------------------
        | CHART DATA
        |--------------------------------------------------------------------------
        */

        $monthlyTasks = Task::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($monthlyTasks as $item) {

            $labels[] = date('M', mktime(0, 0, 0, $item->month, 1));

            $data[] = $item->total;
        }

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'completed')->count();

        $pendingTasks = Task::where('status', 'pending')->count();

        return view('tasks.edit', compact(
            'task',
            'users',
            'labels',
            'data',
            'totalTasks',
            'completedTasks',
            'pendingTasks'
        ));
        

        // return view('tasks.edit', compact('task', 'users'));

    }

    public function update(StoreTaskRequest $request, $id)
{
      $task = $this->service->update($id, $request->validated());

    // dd($task);

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Task Updated Successfully');

}
}