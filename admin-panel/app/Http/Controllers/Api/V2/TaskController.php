<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task;
use App\Models\Task as ModelsTask;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ModelsTask::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::collection(auth()->user()->tasks()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()->tasks()->create($request->validated());

        return Task::make($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelsTask $task)
    {
        return Task::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, ModelsTask $task)
    {
        $task->update($request->validated());

        return Task::make($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsTask $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
