<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function __construct(
        protected TaskService $service
    ) {}

    public function index(Request $request)
    {
        $tasks = $this->service->getAll($request->all());

        return TaskResource::collection($tasks);
    }
}