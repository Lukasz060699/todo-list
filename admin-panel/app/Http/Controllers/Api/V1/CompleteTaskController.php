<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task;
use Illuminate\Http\Request;
use App\Models\Task as ModelTask;
class CompleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ModelTask $task)
    {
        $task->is_completed = $request->is_completed;
        $task->save();

        return Task::make($task);
    }
}
