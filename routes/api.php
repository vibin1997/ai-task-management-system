
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskApiController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/tasks', [TaskApiController::class, 'index']);

});
